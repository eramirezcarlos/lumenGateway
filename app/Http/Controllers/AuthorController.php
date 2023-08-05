<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Return the list of authors
     * @return Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {

    }

    /**
     * Create one new author
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

    }

    /**
     * Obtains and show one author
     * @return Illuminate\Http\JsonResponse
     */
    public function show($author): JsonResponse
    {

    }

    /**
     * Update an existing author
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $author): JsonResponse
    {

    }

    /**
     * Remove an existing author
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy($author): JsonResponse
    {

    }

}