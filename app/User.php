<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

     protected $fillable = ['name', 'surname' , 'email', 'password', 'center', 'status', 'registrated', 'slug', 'created_by', 'modified_by'];

     public function setSlugAttribute($value) {
       $this->attributes['slug'] = is_null($value) ? $this->generateRandomString() : null;
     }

     public function generateRandomString($length = 18) {
       $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $charactersLength = strlen($characters);
       $randomString = '';
       for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
       }
       return $randomString;
     }
     public static function getUser($link) {
       $user = User::where('slug', $link)->get();
       return $user[0];
     }
     public static function completeRegistration($user_id, $data) {
          $user = User::find($user_id);
           $user->email = $data['email'];
           $user->password = $data['password'];
           $user->registrated = 1;
           $user->slug .= 1;
           $user->save();
           return $user;

     }
    public function isAdmin()
    {
        return $this->status;
    }

}
