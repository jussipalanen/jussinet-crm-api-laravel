<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'firstname',
        'lastname',
        'password',
        'address',
        'city',
        'country',
        'phone',
        'person_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Get the person image from the storage directory
     *
     * @return void
     */
    public function getPersonImage()
    {
        return Storage::url('app/' . $this->person_image) ?: null;
    }

   /**
     * This checks, if the person image exists in the storage directory
     *
     * @return void
     */
    public function hasPersonImage()
    {
        return file_exists( Storage::path($this->person_image) ) ? true : false;
    }

}
