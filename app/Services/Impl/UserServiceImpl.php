<?php 

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService {
   private array $users = [
      "ridho" => "rahasia"
   ]; 

   function login(string $user, string $password): bool
   {
      // bila usernya tidak terdaftar
      if(!isset($this->users[$user])) {
         return false;
      }

      $correctPassword = $this->users[$user];
      // bila passwordnya benar
      return $password == $correctPassword;
      // if($password == $correctPassword) {
      //    return true;
      // } else {
      //    return false;
      // }
   }
}