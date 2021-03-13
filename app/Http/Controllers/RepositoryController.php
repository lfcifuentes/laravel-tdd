<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RepositoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return
	 */
	public function index()
	{
		return view('repositories.index', [
			'repositories' => auth()->user()->repositories
		]);
    }

	/**
	 * 
	 */
	public function create()
	{

	}
	/**
	 * Receive data for store in database
	 */
	public function store(Request $request)
	{
		$request->validate([
			'url' => 'required',
			'description' => 'required'
		]);

		$request
			->user()
			->repositories()
			->create(
				$request->all()
			);

		return redirect()->route('repositories.index');
	}
	/**
	 * 
	 */
	public function show()
	{

	}
	/**
	 * 
	 */
	public function edit(Repository $repository)
	{

	}
	/**
	 * Receive data for repository update
	 */
	public function update(Request $request, Repository $repository)
	{
		$request->validate([
			'url' => 'required',
			'description' => 'required'
		]);

		$repository->update($request->all());

		return redirect()->route('repositories.edit', $repository);
	}
	/**
	 * Delete repository
	 */
	public function destroy(Request $request, Repository $repository)
	{
		// eliminar repositorio
		$repository->delete();
		// redireccionar
		return redirect()->route('repositories.index');
	}
}
