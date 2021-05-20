<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class Users_Verified extends Model
{
    protected $table = "users_verified";
    protected $fillable = ['id', 'token', 'user_id'];

    public function users(){
        return $this -> belongsTo(User::class, 'user_id');
    }

}
