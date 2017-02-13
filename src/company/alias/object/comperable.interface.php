<?php
namespace company\alias\object;

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
 * An interface for objects that are comparable with similare objects.
 *
 * @author Arrorn
 * @package company\alias\object
 */
interface Comperable{
    /**
     * Compares two Comperable objects
     *
     * @api
     *
     * @param Comperable $objectA
     * @param Comperable $objectB
     *
     * @return bool
     */
    public static function compare( Comperable $objectA, Comperable $objectB ) : bool;
    /**
     * Compare a Comperable object with current object
     *
     * @api
     *
     * @param Comperable $object
     *
     * @return bool
     */
    public function equals( Comperable $object ) : bool;
}
