<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Response;

/**
 * Class ProductControllerController
 * @package  App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *  path="/products",
     *  operationId="indexProduct",
     *  tags={"Products"},
     *  summary="Get list of Product",
     *  description="Returns list of Product",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Products"),
     *  ),
     * )
     *
     * Display a listing of Product.
     * @return JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(['data' => $products]);
    }
    
    /**
     * @OA\Post(
     *  operationId="storeProduct",
     *  summary="Insert a new Product",
     *  description="Insert a new Product",
     *  tags={"Products"},
     *  path="/products",
     *  @OA\RequestBody(
     *    description="Product to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Product")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Product created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Product"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        $data = Product::create($request->validated('data'));
        return response()->json(['data' => $data], RESPONSE::HTTP_CREATED);
    }
  
    /**
     * @OA\Get(
     *   path="/products/{product_id}",
     *   summary="Show a Product from his Id",
     *   description="Show a Product from his Id",
     *   operationId="showProduct",
     *   tags={"Products"},
     *   @OA\Parameter(ref="#/components/parameters/Product--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Product"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Product not found"),
     * )
     *
     * @param Product $Product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        return response()->json(['data' => $product]);
    }
   
    /**
     * @OA\Patch(
     *   operationId="updateProduct",
     *   summary="Update an existing Product",
     *   description="Update an existing Product",
     *   tags={"Products"},
     *   path="/products/{product_id}",
     *   @OA\Parameter(ref="#/components/parameters/Product--id"),
     *   @OA\Response(response="204",description="No content"),
     *   @OA\RequestBody(
     *     description="Product to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Product")
     *      )
     *     )
     *   )
     * )
     *
     * @param Request $request
     * @param Product $Product
     * @return Response|JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated('data'));
        return response()->json(['data' => $product->refresh()]);
    }

    /**
     * @OA\Delete(
     *  path="/products/{product_id}",
     *  summary="Delete a Product",
     *  description="Delete a Product",
     *  operationId="destroyProduct",
     *  tags={"Products"},
     *  @OA\Parameter(ref="#/components/parameters/Product--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Product not found"),
     * )
     *
     * @param Product $Product
     * @return Response|JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
