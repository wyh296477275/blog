<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    //
    protected $table='user';
    protected $primaryKey= 'id';
    public $timestamps = false;
}
