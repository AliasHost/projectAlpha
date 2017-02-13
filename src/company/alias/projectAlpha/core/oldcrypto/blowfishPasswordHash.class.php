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
class BlowfishPasswordHash extends GenericPasswordHash
{
    static protected $cost = 14;
    static protected $algorithm = '2y';
    static protected $randomCode = 12;
    static protected $saltSize = 22;

    public function __construct(string $password, string $salt, string $hash = null)
    {
        if(!isset($hash) || $hash === ''){
            $hash = static::createHash($password, $salt);
        }
        parent::__construct($password,$salt,$hash);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function validatePassword() : bool
    {
        return static::slowEquals(crypt($this->password, $this->hash), $this->hash);
    }

    static public function createHash(string $password, string $salt) : string
    {
        return crypt($password, $salt);
    }
    static public function generateSalt() : string
    {
        $random = '';
        if(function_exists('random_bytes'))
        {
            $random = random_bytes(static::$saltSize);
        }
        elseif (function_exists('mcrypt_create_iv'))
        {
            $random = mcrypt_create_iv(static::$saltSize, MCRYPT_DEV_URANDOM);
        }
        elseif (function_exists('openssl_random_pseudo_bytes'))
        {
            $random = openssl_random_pseudo_bytes(static::$saltSize);
        }
        else
        {
            throw new Exception('No cryptographically secure source for random bytes could be found.',static::$randomCode);
        }
        if(static::hasMultiByte())
        {
            $random = str_replace('+','.',mb_substr(base64_encode($random),0,static::$saltSize));
        }
        else
        {
            $random = str_replace('+','.',substr(base64_encode($random),0,static::$saltSize));
        }
        return '$'.implode('$',array(static::$algorithm,str_pad(static::$cost,2,'0',STR_PAD_LEFT),$random));
    }

}


?>
