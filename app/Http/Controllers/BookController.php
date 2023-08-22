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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create one new Book
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        
        try {
            $authorResponse = $this->authorService->obtainAuthor($request->author_id);

            // Check if the response contains a 404 status code
            if ( isset(json_decode($authorResponse, true)['code'] )  && json_decode($authorResponse, true)['code'] >= 400) {
                // The author was not found, return a 404 response
                return $this->errorResponse(json_decode($authorResponse, true)['error'], json_decode($authorResponse, true)['code'] );                
            }else{
                return $this->successResponse($this->bookService->createBook($request->all(), Response::HTTP_CREATED));
            }

        } catch (HttpClientException $e) {
            
            return $this->errorResponse('An error occurred ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }

    /**
     * Obtains and show one Book
     * @return Illuminate\Http\JsonResponse
     */
    public function show($book)
    {
        return $this->successResponse($this->bookService->obtainBook($book));
    }

    /**
     * Update an existing Book
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $book)
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $book));        
    }

    /**
     * Remove an existing Book
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy($book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));         
    }


}