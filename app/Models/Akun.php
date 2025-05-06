<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use HasFactory, Notifiable;
    
    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id_akun';
    
    // Specify that the primary key is not auto-incrementing if it's a string
    public $incrementing = false;
    
    // Tell Laravel this is not the default 'users' table
    protected $table = 'akun';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_akun',
        'id_level',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}