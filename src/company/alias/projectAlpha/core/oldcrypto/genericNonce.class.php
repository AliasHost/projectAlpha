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
class GenericNonce implements Nonce
{
    protected $nonce = '';

    public function __construct(int $length)
    {
        $random = '';
        if(function_exists('random_bytes'))
        {
            $random = random_bytes($length);
        }
        elseif (function_exists('mcrypt_create_iv'))
        {
            $random = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
        }
        elseif (function_exists('openssl_random_pseudo_bytes'))
        {
            $random = openssl_random_pseudo_bytes($length);
        }
        else
        {
            throw new Exception('No cryptographically secure source for random bytes could be found.',static::$randomCode);
        }
        $this->nonce = $random;
    }

    public function __toString() : string
    {
        return $this->getNonce();
    }

    public function getNonce() : string
    {
        return $this->nonce;
    }
}

?>
