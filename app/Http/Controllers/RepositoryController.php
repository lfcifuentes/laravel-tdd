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
		return view('repositories.create');
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
	 * Show repository data
	 */
	public function show(Request $request, Repository $repository)
	{
		if($request->user()->id != $repository->user_id){
			abort(403);
		}

		return view('repositories.show', \compact('repository'));
	}
	/**
	 * Show repository edit form
	 */
	public function edit(Request $request, Repository $repository)
    {
        if ($request->user()->id != $repository->user_id) {
            abort(403);
        }

        return view('repositories.edit', compact('repository'));
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

		if($request->user()->id != $repository->user_id){
			abort(403);
		}

		$repository->update($request->all());

		return redirect()->route('repositories.edit', $repository);
	}
	/**
	 * Delete repository
	 */
	public function destroy(Request $request, Repository $repository)
	{
		if($request->user()->id != $repository->user_id){
			abort(403);
		}

		// eliminar repositorio
		$repository->delete();
		// redireccionar
		return redirect()->route('repositories.index');
	}
}
