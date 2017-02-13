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
interface User{

    public function authenticate() : bool;

    public function hasPermission( Permission $perm ) : bool;
    public function hasPermGroup( PermissionGroup $group ) : bool;
    public function addPermGroup( PermissionGroup $group ) : bool;
    public function removePermGroup( PermissionGroup $group ) : bool;

    public function isAuthenticated() : bool;

    public function getUsername() : string;
    public function getIP() : string;
    public function getName() : string;
    public function getAge() : string;
    public function getGender() : bool;
    public function getCountry() : int;
    public function getFavoriteSongs() : Playlist;
    public function getBio() : string;

    public function setName(string $name) : bool;
    public function setAge(int $age) : bool;
    public function setCountry(int $country) : bool;
    public function setBio(string $bio) : bool;

}

?>
