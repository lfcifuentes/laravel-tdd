<?php

namespace App\Http\Controllers;

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
	public function store(Request $request)
	{
		$request
			->user()
			->repositories()
			->create(
				$request->all()
			);

		return redirect()->route('repositories.index');
	}
	public function show()
	{

	}
	public function edit()
	{

	}
	public function update(Request $request)
	{

	}

	public function destroy(Request $request)
	{

	}
}
