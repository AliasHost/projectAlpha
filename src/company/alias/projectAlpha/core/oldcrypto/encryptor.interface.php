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
interface Encryptor
{
    public function genericHash(string $message, string $key = null, int $length = 32) : string;
    public function splitKeys(string $key) : array;
    public function encrypt(string $message, string $nonce, string $key) : string;
    public function authenticate(string $message, string $key) : string;
    public function 
}
