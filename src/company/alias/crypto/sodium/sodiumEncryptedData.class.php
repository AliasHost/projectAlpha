<?php
namespace company\alias\crypto\sodium;
use \company\alias\crypto\LibraryImplementation;
use company\alias\crypto\Aes256CtrEncryptedData;

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
class SodiumEncryptedData extends Aes256CtrEncryptedData implements LibraryImplementation{
    public static function isLoaded() : bool
    {
        return false;
    }
}
