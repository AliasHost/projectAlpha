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
abstract class Crypto
{

    static public function getPasswordHash(string $password, string $salt, string $hash = null) : PasswordHash
    {
        return (SodiumPasswordHash::hasSodium()) ? new SodiumPasswordHash($password, $salt, $hash) : new BlowfishPasswordHash($password, $salt, $hash);
    }

    static public function generateSalt() : string
    {
        return (SodiumPasswordHash::hasSodium()) ? SodiumPasswordHash::generateSalt() : BlowfishPasswordHash::generateSalt();
    }

    static public function getNonce(int $length) : Nonce
    {
        return (SodiumNonce::hasSodium()) ? new SodiumNonce($length) : new GenericNonce($length);
    }

    static public function getCookie() : Cookie
    {
        return (SodiumCookie::hasSodium()) ? new SodiumCookie() : new GenericCookie();
    }

}

?>
