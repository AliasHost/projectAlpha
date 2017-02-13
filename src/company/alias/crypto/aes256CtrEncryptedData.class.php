<?php
namespace company\alias\crypto;
use \company\alias\crypto\string\CryptographicString;
use \company\alias\crypto\EncryptedData;
use \company\alias\object\Comperable;

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
 * AES 256 Implementation of Encrypted Data
 *
 * @author Arrorn
 * @package company\alias\crypto
 */
class Aes256CtrEncryptedData extends CryptographicString implements EncryptedData{

    private $mode = 'encrypt';
    private $unencrypted = '';
    private $encrypted = '';
    private $calculatedMAC = '';
    private $splitMAC = '';
    private $unsplitKey = '';
    private $authKey = '';
    private $encyptKey = '';

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     *
     */
    public function __destruct()
    {

    }
    public function __toString() : string
    {
        return '';
    }
    public static function compare( Comperable $objectA, Comperable $objectB ) : bool
    {
        return false;
    }
    public function equals( Comperable $object ) : bool
    {
        return static::compare($this,$object);
    }

    /**
     * @return string
     */
    public function serialize() : string
    {

    }

    /**
     * @param string $serialized
     *
     * @return void
     */
    public function unserialize( $serialized )
    {

    }
    public function getEncryptedData() : string
    {

    }
    /**
     * Sets the encrypted data to be decrypted.
     *
     * Sets the ciphertext to be decrypted, should be in the form of MAC +
     * Nonce/IV + Ciphertext
     *
     * @param string $encryptedData
     *
     * @return bool Success
     */
    protected function setEncryptedData(string $encryptedData) : bool
    {

    }
    public function getPlaintextData() : string
    {

    }
    /**
     * Sets the plaintext to be encrypted.
     *
     * @param string $decryptedData
     *
     * @return bool Success
     */
    protected function setPlaintextData(string $decryptedData) : bool
    {

    }
    /**
     * Sets the key to be used to encrypt/decrypt and authenticate.
     *
     * Sets the key to be used for the encryption/decryption and authentication
     * processes. This key will then be split into the encryption and
     * authentication keys, using the static method splitKeys.
     *
     * @param string $key
     *
     * @return bool Success
     */
    protected function setKey(string $key) : bool
    {

    }
    /**
     * Sets the key to be used to encrypt and decrypt.
     *
     * @param string $encryptionKey
     *
     * @return bool Success
     */
    protected function setEncryptionKey(string $encryptionKey) : bool
    {

    }
    /**
     * Sets the key to be used for authentication.
     *
     * @param string $authenticationKey
     *
     * @return bool Success
     */
    protected function setAuthenticationKey(string $authenticationKey) : bool
    {

    }
    /**
     * Get the Hashed Message Authentication Code of the encrypted data.
     *
     * @return string HMAC
     */
    protected function getMAC() : string
    {

    }
    /**
     * Authenticates the supplied MAC with recalculated MAC.
     *
     * Recalculates the MAC for the encrypted data, compares this MAC with the
     * MAC supplied in the encrypted data.
     *
     * This comparison should be a constant time function and should not exit
     * mid-comparison to prevent timing attacks. Another method to prevent
     * timing attacks is to re-MAC both MAC's using the Authentication key, as
     * this would sufficiently randomize the bits so that any change of a bit
     * during a timing attack would have an unpredictable avalanche affect on
     * the secondary MAC's. Further explanation of Double HMAC verification to
     * protect from timing attacks can be found at NCCGroup.trust blog archive
     * from February of 2011
     *
     * @link https://www.nccgroup.trust/us/about-us/newsroom-and-events/blog/2011/february/double-hmac-verification/ NCCGroup Blog
     *
     * @return bool Success
     */
    protected function isAuthenticated() : bool
    {

    }
    public function encrypt(string $decryptedData, string $key) : bool
    {

    }
    public function decrypt(string $encryptedData, string $key) : bool
    {

    }
    /**
     * Generates an encryption and authentication key of appropriate cipher
     * length.
     *
     * Uses a secure keyed message digest function to generate encryption
     * and authentication keys of a length suitable for the used symmetcial
     * encryption cipher.
     *
     * @api
     *
     * @param string $key
     *
     * @return string[] Array containing encryption key and authentication key
     */
    protected static function splitKeys(string $key) : array
    {

    }

    /**
     * @return bool
     */
    public static function hasMcrypt() : bool
    {
        return function_exists('/mcrypt_encrypt');
    }

    /**
     * @return bool
     */
    public static function hasOpenSsl() : bool
    {
        return function_exists('/openssl_encrypt');
    }
}
