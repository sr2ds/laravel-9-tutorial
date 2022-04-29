<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Response;

/**
 * Class BookControllerController
 * @package  App\Http\Controllers
 */
class BookController extends Controller
{
    /**
     * @OA\Get(
     *  path="/books",
     *  operationId="indexBook",
     *  tags={"Books"},
     *  summary="Get list of Book",
     *  description="Returns list of Book",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Books"),
     *  ),
     * )
     *
     * Display a listing of Book.
     * @return JsonResponse
     */
    public function index()
    {
        $books = Book::all();
        return response()->json(['data' => $books]);
    }
    
    /**
     * @OA\Post(
     *  operationId="storeBook",
     *  summary="Insert a new Book",
     *  description="Insert a new Book",
     *  tags={"Books"},
     *  path="/books",
     *  @OA\RequestBody(
     *    description="Book to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Book")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Book created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Book"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request)
    {
        $data = Book::create($request->validated('data'));
        return response()->json(['data' => $data], RESPONSE::HTTP_CREATED);
    }
  
    /**
     * @OA\Get(
     *   path="/books/{book_id}",
     *   summary="Show a Book from his Id",
     *   description="Show a Book from his Id",
     *   operationId="showBook",
     *   tags={"Books"},
     *   @OA\Parameter(ref="#/components/parameters/Book--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Book"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Book not found"),
     * )
     *
     * @param Book $Book
     * @return JsonResponse
     */
    public function show(Book $book)
    {
        return response()->json(['data' => $book]);
    }
   
    /**
     * @OA\Patch(
     *   operationId="updateBook",
     *   summary="Update an existing Book",
     *   description="Update an existing Book",
     *   tags={"Books"},
     *   path="/books/{book_id}",
     *   @OA\Parameter(ref="#/components/parameters/Book--id"),
     *   @OA\Response(response="204",description="No content"),
     *   @OA\RequestBody(
     *     description="Book to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Book")
     *      )
     *     )
     *   )
     * )
     *
     * @param Request $request
     * @param Book $Book
     * @return Response|JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated('data'));
        return response()->json(['data' => $book->refresh()]);
    }

    /**
     * @OA\Delete(
     *  path="/books/{book_id}",
     *  summary="Delete a Book",
     *  description="Delete a Book",
     *  operationId="destroyBook",
     *  tags={"Books"},
     *  @OA\Parameter(ref="#/components/parameters/Book--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Book not found"),
     * )
     *
     * @param Book $Book
     * @return Response|JsonResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->noContent();
    }
}
