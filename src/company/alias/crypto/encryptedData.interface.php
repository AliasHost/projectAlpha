<?php
namespace company\alias\crypto;
use \company\alias\object\Comperable;
use \Serializable;

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
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @copyright 2016 Alias LLC.
 */


/**
 * An interface for encrypting data.
 *
 * @author Arrorn
 * @package company\alias\crypto
 */
interface EncryptedData extends Serializable, Comperable{
    /**
     * Gets the ciphertext that has been encrypted.
     *
     * Returns the ciphertext in the form of MAC + Nonce/IV + Ciphertext.
     *
     * @api
     *
     * @return string MAC + /Nonce/IV + Ciphertext
     */
    public function getEncryptedData() : string;
    /**
     * Gets the plaintext that has been decrypted.
     *
     * @api
     *
     * @return string Plaintext
     */
    public function getPlaintextData() : string;
    /**
     * Encrypts the paintext with the given key.
     *
     * Encrypts the plaintext with the key and stores both the plaintext and
     * generated ciphertext. Returns true on success.
     *
     * @api
     *
     * @param string $decryptedData
     * @param string $key
     *
     * @return bool Success
     */
    public function encrypt(string $decryptedData, string $key) : bool;
    /**
     * Decrypts the ciphertext with the given key.
     *
     * Decrypts the ciphertext with the key and stores both the ciphertext and
     * generated plaintext. Returns true on success.
     *
     * @param string $encryptedData
     * @param string $key
     *
     * @return bool Success
     */
    public function decrypt(string $encryptedData, string $key) : bool;
}
?>
