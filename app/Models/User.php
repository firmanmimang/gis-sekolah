<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allData()
    {
        return DB::table('users')->get();
    }

    public function insertData($data)
    {
        DB::table('users')->insert($data);
    }

    public function detailData($username)
    {
        return DB::table('users')->where('username', $username)->first();
    }

    public function updateData($username, $data)
    {
        DB::table('users')->where('username', $username)->update($data);
    }

    public function deleteData($username)
    {
        DB::table('users')->where('username', $username)->delete();
    }
}
