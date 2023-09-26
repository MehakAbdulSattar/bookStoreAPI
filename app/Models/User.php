<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    public function books()
    {
        return $this->hasMany(Post::class);
    }

    public function update(User $user, User $profile)
    {
        // Users can update their own profile
        return $user->id === $profile->id;
    }

    public function show(User $user, User $profile)
    {
        // Users can view their own profile
        return $user->id === $profile->id;
    }

    public function destroy(User $user, User $profile)
    {
        // Admin users can delete any user's profile
        return $user->isAdmin() && $user->id !== $profile->id;
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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



    
}

