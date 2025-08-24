<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    // Role relationship
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function customerProfile()
    {
        return $this->hasOne(Customer::class);
    }

    public function deliveryManProfile()
    {
        return $this->hasOne(DeliveryMan::class);
    }

    public function restaurantProfile()
    {
        return $this->hasOne(Restaurant::class);
    }

    // Helper methods
    public function hasRole($roleName)
    {
        return $this->roles()->where('slug', $roleName)->exists();
    }

    public function assignRole($roleName)
    {
        $role = Role::firstOrCreate(['name' => $roleName, 'slug' => Str::slug($roleName)]);
        $this->roles()->syncWithoutDetaching([$role->id]);
    }
}
