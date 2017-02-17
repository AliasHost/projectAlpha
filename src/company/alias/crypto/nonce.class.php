<?php
namespace company\alias\crypto;
use \company\alias\crypto\RandomData;
use \company\alias\crypto\string\CryptographicString;
use \Exception;
use \InvalidArgumentException;

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
class Nonce extends CryptographicString implements RandomData{

    /**
     * @param int $length
     */
    public function __construct(int $length){
        if($length <= 0)
        {
            throw new InvalidArgumentException('Length must be greater than 0');
        }
        $rand = "";
        $strong = true;
        if (static::hasRandomBytes())
        {
            $rand = random_bytes($length);
        }
        elseif (static::hasMcryptCreateIV())
        {
            $rand = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
        }
        elseif (static::hasOpenSSLRandomPseudoBytes())
        {
            $rand = openssl_random_pseudo_bytes($length,$strong);
        }
        if(static::hasMultiByte())
        {
            $len = mb_strlen($rand, '8bit');
        }
        else
        {
            $len = strlen($rand);
        }
        if($len === 0 || !$strong)
        {
            throw new Exception('No cryptographically secure source for random bytes could be found.', 1);
        }
        parent::__construct($rand);
    }

    /**
     * @return string
     */
    static public function hasRandomBytes() : bool
    {
        return function_exists('\random_bytes');
    }

    /**
     * @return string
     */
    static public function hasMcryptCreateIV() : bool
    {
        return function_exists('\mcrypt_create_iv');
    }

    /**
     * @return string
     */
    static public function hasOpenSSLRandomPseudoBytes() : bool
    {
        return function_exists('\openssl_random_pseudo_bytes');
    }

}
