<?php
namespace company\alias\crypto\string;
use \company\alias\object\Comperable;
use \Exception;

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
 * A wrapper for a string that employs time constant comparison.
 *
 * @author Arrorn
 * @package company\alias\crypto\string
 */
class CryptographicString implements Comperable{
    /**
     * @var string $wrapped The string that is wrapped by this instance
     */
    private $wrapped = '';

    /**
     *
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->wrapped = $value;
    }

    /**
     *
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->wrapped;
    }

    /**
     *
     *
     * @return string
     */
    public function getString() : string
    {
        return $this->wrapped;
    }

    /**
     *
     *
     * @param string $value
     *
     * @return void
     */
    public function setString(string $value)
    {
        $this->wrapped = $value;
    }

    public static function compare( Comperable $objectA, Comperable $objectB ) : bool
    {
        $stringA = '';
        $stringB = '';
        if(!is_a($objectA,'CryptographicString') && !method_exists($objectA,'__toString'))
        {
            try
            {
                $stringA = serialize($objectA);
            }
            catch (Exception $e)
            {
                $stringA = get_class($objectA);
            }
        }
        else
        {
            $stringA = $objectA->__toString();
        }
        if(!is_a($objectB,'CryptographicString') && !method_exists($objectB,'__toString'))
        {
            try
            {
                $stringB = serialize($objectB);
            }
            catch (Exception $e)
            {
                $stringB = get_class($objectB);
            }
        }
        else
        {
            $stringB = $objectB->__toString();
        }
        $lenA = 0;
        $lenB = 0;
        if(static::hasMultiByte())
        {
            $lenA = (int) mb_strlen($stringA,'8bit');
            $lenB = (int) mb_strlen($stringB,'8bit');
        }
        else
        {
            $lenA = strlen($stringA);
            $lenB = strlen($stringB);
        }
        if($lenA == $lenB && CryptographicString::hasHashEquals())
        {
            return hash_equals($stringA, $stringB);
        }
        $diff = 0;
        for($i = 0;$i < $lenA && $i < $lenB; ++$i)
        {
            $diff += (int)!($stringA[$i] === $stringB[$i]);
        }
        return !$diff && !($lenA - $lenB);
    }
    public function equals( Comperable $object ) : bool
    {
        return static::compare($this,$object);
    }

    /**
     *
     *
     * @return bool
     */
    static public function hasMultiByte() : bool
    {
        return function_exists('\mb_strlen') && function_exists('\mb_substr');
    }

    /**
     * @return bool
     */
    static public function hasHashEquals() : bool
    {
        return function_exists('\hash_equals');
    }
}
