<?php
namespace App\Repositories;

/*
 * Interfaces BaseRepositoryInterfaces
 * @package App\Repositories
 * */
interface BaseRepositoryInterfaces
{
	public function with($properties);
	public function all();
	public function find($id);
	public function paginate($perPage);
	public function create($request);
	public function update($id, $properties);
	public function delete($id);
	public function forceDeleteEloquent();
}