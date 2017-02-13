<?php

/*   Copyright 2016 Alias LLC.

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/

/**
 *
 */
class SodiumPasswordHash extends GenericPasswordHash implements Sodium
{
    use GenericSodium;

    public function __construct(string $password, string $salt, string $hash = null)
    {
        if(!self::hasSodium()){
            self::noSodium();
        }
        if(!isset($hash) || $hash === ''){
            $hash = static::createHash($password, $salt);
        }
        parent::__construct($password,$salt,$hash);
    }

    public function __destruct()
    {
        if(static::hasSodium()){
            \Sodium\memzero($this->password);
            \Sodium\memzero($this->salt);
            \Sodium\memzero($this->hash);
            return;
        }
        parent::__destruct();
    }

    public function validatePassword() : bool
    {
        return static::hasSodium() ? \Sodium\crypto_pwhash_scryptsalsa208sha256_str_verify($this->hash, $this->salt . $this->password) : static::noSodium();
    }

    public function getHash() : string
    {
        return $this->hash;
    }

    static public function createHash(string $password, string $salt) : string
    {
        return static::hasSodium() ? \Sodium\crypto_pwhash_scryptsalsa208sha256_str($salt . $password, \Sodium\CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_INTERACTIVE, \Sodium\CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_INTERACTIVE) : (string) static::noSodium();
    }
    static public function generateSalt() : string
    {
        return static:hasSodium() ? \Sodium\randombytes_buf(\Sodium\CRYPTO_PWHASH_SCRYPTSALSA208SHA256_SALTBYTES) : (string) static::noSodium();
    }
    static public function hasSodium() : bool
    {
        return function_exists('\Sodium\crypto_pwhash_scryptsalsa208sha256_str') && function_exists('\Sodium\crypto_pwhash_scryptsalsa208sha256_str_verify') && function_exists('\Sodium\randombytes_buf') && function_exists('\Sodium\memzero') && function_exists('\Sodium\memcmp');
    }
    static public function slowEquals(string $hashA, string $hashB) : bool
    {
        return static::hasSodium() ? \Sodium\memcmp($hashA, $hashB) === 0 : static::noSodium();
    }

}


?>
