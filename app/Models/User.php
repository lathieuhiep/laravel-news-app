<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Laravel\Sanctum\HasApiTokens;
use LaravelIdea\Helper\App\Models\_IH_User_C;

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
    ];

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

	// check user has management
    public function isAdmin(): bool
    {
        $isAdmin = [
			Config::get('constants.ROLE_ADMIN'),
	        Config::get('constants.ROLE_EDITOR')
        ];
		
        $role = $this->role()->first();

        if ( !empty( $role ) && in_array( $role->slug, $isAdmin ) ) {
            return true;
        }

        return false;
    }

	// get role permissions user
    public function getUserRole()
    {
        $role = $this->role()->first();

        if ( !empty( $role ) ) {
            return $role->name;
        }

        return '';
    }
	
	// get users has management
	public function getManagementUsers(): Collection
	{
		return User::query()
			->join('users_roles', 'users.id', '=', 'users_roles.user_id')
			->join('roles', 'users_roles.role_id', '=', 'roles.id')
			->whereIn('roles.slug', [
				Config::get('constants.ROLE_ADMIN'),
				Config::get('constants.ROLE_EDITOR')
			])
			->select('users.id', 'users.name')
			->get();
	}
}
