<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    use ApiResponser;

    /* 
     the service to consule the author service using injection
     @var AuthorService
    */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return the list of authors
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {        
        return $this->successResponse( $this->authorService->obtainAuthors() );
    }

    /**
     * Create one new author
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        return $this->successResponse($this->authorService->createAuthor($request->all(), Response::HTTP_CREATED));

    }

    /**
     * Obtains and show one author
     * @return Illuminate\Http\JsonResponse
     */
    public function show($author)
    {
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }

    /**
     * Update an existing author
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    /**
     * Remove an existing author
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }

}