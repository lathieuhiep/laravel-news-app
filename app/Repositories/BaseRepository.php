<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterfaces
{
	protected $model;
	
	/*
	 * BaseRepository construct
	 *
	 * @param Model $model
	 * */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}
	
	public function with($properties): Builder
	{
		return $this->model->with($properties);
	}
	
	public function all(): Collection
	{
		return $this->model->all();
	}
	
	public function find($id)
	{
		return $this->model->find($id);
	}
	
	public function paginate($perPage = 10)
	{
		return $this->model->paginate($perPage);
	}
	
	public function create($request)
	{
		return $this->model->create($request);
	}
	
	public function update($id, $properties)
	{
		return $this->model->find($id)->update($properties);
	}
	
	public function delete($id)
	{
		return $this->model->find($id)->delete();
	}
	
	public function forceDeleteEloquent(): ?bool
	{
		return $this->model->forceDelete();
	}
}