<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password', 'role'];
    
    protected $hidden = ['password', 'remember_token'];
   
}

