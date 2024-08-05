<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'remember_token',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Service methods for CRUD
     */


    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->get();
    }

    public function updateUser($data, $id)
    {
        return $this->findOrFail($id)->update($data);
    }

    public function getUserByTokenAndEmail($token, $email)
    {
        return $this->where('email', $email)->where('remember_token', $token)->get();
    }

    public function getAllUsers()
    {
        return $this->where('status', 1)->get();
    }

    public function addUser($data)
    {
        return $this->create($data);
    }

    public function deleteUser($id)
    {
        return $this->find($id)->delete();
    }

    public function findUserById($id)
    {
        return $this->where('id', $id)->where('status', '1')->firstOrFail();
    }

}
