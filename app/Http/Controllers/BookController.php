<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Traits\ConsumesExternalService;
use App\Services\BookService;
use App\Services\AuthorService;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the books microservice
     * @var BookService
     */    
    public $bookService;


    /**
     * The service to consume the authors microservice
     * @var AuthorService
     */
    public $authorService;    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return the list of Books
     * @return Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create one new Book
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->authorService->obtainAuthor($request->author_id);
        return $this->successResponse($this->bookService->createBook($request->all(), Response::HTTP_CREATED));

    }

    /**
     * Obtains and show one Book
     * @return Illuminate\Http\JsonResponse
     */
    public function show($book): JsonResponse
    {
        return $this->successResponse($this->bookService->obtainBook($book));
    }

    /**
     * Update an existing Book
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $book): JsonResponse
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $book));        
    }

    /**
     * Remove an existing Book
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy($book): JsonResponse
    {
        return $this->successResponse($this->bookService->deleteBook($book));         
    }


}