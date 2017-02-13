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
abstract class GenericPasswordHash implements PasswordHash, Serializable{

    protected $hash = '';
    protected $salt = '';
    protected $password = '';

    public function __construct(string $password, string $salt, string $hash = null)
    {
        if(isset($hash) && $hash !== ''){
            $this->hash = $hash;
        }
        $this->salt = $salt;
        $this->password = $password;
    }

    public function __destruct()
    {
        $this->password = '';
        $this->salt = '';
        $this->hash = '';
        unset($this->password);
        unset($this->salt);
        unset($this->hash);
    }

    public function getHash() : string
    {
        return $this->hash;
    }

    public function __toString() : string
    {
        return $this->getHash();
    }

    public function serialize() : string
    {

    }

    public function unserialize( string $serialized )
    {

    }

    static public function slowEquals(string $hashA, string $hashB) : bool
    {
        $lenA = 0;
        $lenB = 0;
        if(static::hasMultiByte())
        {
            $lenA = (int) mb_strlen($hashA,'8bit');
            $lenB = (int) mb_strlen($hashB,'8bit');
        }
        else
        {
            $lenA = strlen($hashA);
            $lenB = strlen($hashB);
        }
        //hash_equals will immediately return if $lenA != $lenB. Defeats the purpose of a constant time comparison.
        if($lenA == $lenB && function_exists('hash_equals'))
        {
            return hash_equals($hashA, $hashB);
        }
        $diff = 0;
        for($i = 0;$i < $lenA && $i < $lenB; ++$i)
        {
            $diff += (int)!($hashA[$i] === $hashB[$i]);
        }
        return !$diff && !($lenA - $lenB);
    }

    static public function hasMultiByte() : bool
    {
        return function_exists('mb_strlen') && function_exists('mb_substr');
    }

}

?>
