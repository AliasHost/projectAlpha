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
class GenericUser implements User
{

    protected $username = "";
    protected $ip = "";
    protected $passwd = null;
    protected $auth = false;
    protected $permissions = array();
    protected $permissionGroups = array();
    protected $name = "";
    protected $age = -1;
    protected $gender = false;
    protected $country = -1;
    protected $favoriteSongs = null;
    protected $bio = "";

    public function __construct(string $username, string $ip, string $passwd, string $name, int $age, bool $gender, int $country, string $bio = '' ,array $permissions = null, array $permissionGroups = null)
    {
        $favoriteSongs = new Playlist();
        $salt = Crypto::generateSalt();
        $hash = Crypto::getPasswordHash($passwd, $salt);
    }

    public function authenticate() : bool
    {
        return false;
    }

    public function hasPermission( Permission $perm ) : bool
    {
        return false;
    }

    public function hasPermGroup( PermissionGroup $group ) : bool
    {
        return false;
    }

    public function addPermGroup( PermissionGroup $group ) : bool
    {
        return false;
    }

    public function removePermGroup( PermissionGroup $group ) : bool
    {
        return false;
    }

    public function isAuthenticated() : bool
    {
        return $this->auth;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function getIP() : string
    {
        return $this->ip;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getAge() : string
    {
        return $this->age;
    }

    public function getGender() : bool
    {
        return $this->gender;
    }

    public function getCountry() : int
    {
        return $this->country;
    }

    public function getFavoriteSongs() : Playlist
    {
        return &$this->favoriteSongs;
    }

    public function getBio() : string
    {
        return $this->bio;
    }

    public function setName(string $name) : bool
    {
        return false;
    }

    public function setAge(int $age) : bool
    {
        return false;
    }

    public function setCountry(int $country) : bool
    {
        return false;
    }

    public function setBio(string $bio) : bool
    {
        return false;
    }


}


?>
