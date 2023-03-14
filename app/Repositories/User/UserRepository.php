<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Config;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
	public function __construct(User $model)
	{
		parent::__construct($model);
	}
	
	// get user list management
	public function getManagementUsers()
	{
		return $this->model->join('users_roles', 'users.id', '=', 'users_roles.user_id')
			->join('roles', 'users_roles.role_id', '=', 'roles.id')
			->whereIn('roles.slug', [
				Config::get('constants.ROLE_ADMIN'),
				Config::get('constants.ROLE_EDITOR')
			])
			->select('users.id', 'users.name')
			->get();
	}
}