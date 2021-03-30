<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\RepositoryRequest;

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
		return view('repositories.create');
	}
	/**
	 * Receive data for store in database
	 */
	public function store(RepositoryRequest $request)
	{
		$request
			->user()
			->repositories()
			->create(
				$request->all()
			);

		return redirect()->route('repositories.index');
	}
	/**
	 * Show repository data
	 */
	public function show(Repository $repository)
	{
		// check RepositoryPolicy
		$this->authorize('pass', $repository);

		return view('repositories.show', \compact('repository'));
	}
	/**
	 * Show repository edit form
	 */
	public function edit(Repository $repository)
    {
		// check RepositoryPolicy
		$this->authorize('pass', $repository);

        return view('repositories.edit', compact('repository'));
    }
	/**
	 * Receive data for repository update
	 */
	public function update(RepositoryRequest $request, Repository $repository)
	{
		// check RepositoryPolicy
		$this->authorize('pass', $repository);

		$repository->update($request->all());

		return redirect()->route('repositories.edit', $repository);
	}
	/**
	 * Delete repository
	 */
	public function destroy(Repository $repository)
	{
		// check RepositoryPolicy
		$this->authorize('pass', $repository);

		// eliminar repositorio
		$repository->delete();
		// redireccionar
		return redirect()->route('repositories.index');
	}
}
