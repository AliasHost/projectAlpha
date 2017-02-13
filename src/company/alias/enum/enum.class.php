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
class Enum{

    private $name, $ordinal;
    private $properties;
    private $methods;
    private static $staticMethods = null;

    public function __construct($name, $ordinal, $properties = null, $methods = null, $staticMethods = null){
        if(!is_string($name)){
            throw new InvalidArgumentException("Enum constant must be a string");
        }
        if(!is_int($ordinal)){
            throw new InvalidArgumentException("Enum ordinal must be an integer");
        }
        if(!is_array($properties) && $properties != null){
            throw new InvalidArgumentException("Enum properties must be a map of valid string names and properties");
        }
        else{
            foreach($properties as $propertyName => $property){
                if(!is_string($propertyName)){
                    throw new InvalidArgumentException("Enum properties must be a map of valid string names and properties");
                }
            }
        }
        if(!is_array($methods) && $methods != null){
            throw new InvalidArgumentException("Enum methods must be a map of valid string names and functions");
        }
        else{
            foreach($methods as $methodName => $methodFunction){
                if(!is_string($methodName)){
                    throw new InvalidArgumentException("Enum methods must be a map of valid string names and functions");
                }
                if(!is_callable($methodFunction)){
                    throw new InvalidArgumentException("Enum methods must be a map of valid string names and functions");
                }
            }
        }
        if(!is_array($staticMethods) && $staticMethods != null){
            throw new InvalidArgumentException("Enum static methods must be a map of valid string names and functions");
        }
        else{
            foreach($staticMethods as $methodName => $methodFunction){
                if(!is_string($methodName)){
                    throw new InvalidArgumentException("Enum static methods must be a map of valid string names and functions");
                }
                if(!is_callable($methodFunction)){
                    throw new InvalidArgumentException("Enum static methods must be a map of valid string names and functions");
                }
            }
        }
        $this->name = (string) $name;
        $this->ordinal = (int) $ordinal;
        $this->properties = $properties;
        $this->methods = $methods;
        static::$staticMethods = $staticMethods;
    }

    public function __call($name, $args){
        if(!isset($this->methods[$name])){
            throw new BadMethodCallException("Method of ".$name." does not exist on this enum constant");
        }
        return $this->methods[$name](...$args);
    }

    public static function __callStatic($name, $args){
        if(!isset(static::$staticMethods[$name])){
            throw new BadMethodCallException("Static Method of ".$name." does not exist on this enum constant");
        }
        return static::$staticMethods[$name](...$args);
    }

    public function __get($name){
        return (isset($this->properties[$name])) ? $this->$properties[$name] : null;
    }

    public final function name(){
        return $this->name;
    }

    public final function ordinal(){
        return $this->ordinal;
    }

    public function toString(){
        return $this->name;
    }

    public function __toString(){
        return $this->toString();
    }

}

?>
