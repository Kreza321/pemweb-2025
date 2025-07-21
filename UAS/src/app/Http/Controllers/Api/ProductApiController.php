<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="Product API Documentation",
 *   description="API Documentation for Product Management with encryption and API Key authentication.",
 *   @OA\Contact(email="support@example.com"),
 *   @OA\License(name="Apache 2.0", url="http://www.apache.org/licenses/LICENSE-2.0.html")
 * )
 * @OA\Server(
 *   url="http://localhost/api",
 *   description="API Server"
 * )
 * @OA\Tag(
 *   name="Products",
 *   description="API Endpoints for Product Management"
 * )
 * @OA\SecurityScheme(
 *   securityScheme="ApiKeyAuth",
 *   type="apiKey",
 *   in="header",
 *   name="X-API-KEY",
 *   description="Enter your API Key as X-API-KEY in the header"
 * )
 * @OA\Schema(
 *   schema="Product",
 *   title="Product Model",
 *   description="Product object model",
 *   @OA\Property(property="id", type="integer", format="int64", readOnly=true),
 *   @OA\Property(property="name", type="string", example="Example Product"),
 *   @OA\Property(property="price", type="number", format="float", example=99.99),
 *   @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
 *   @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
 * )
 */
class ProductApiController extends Controller
{
    /**
     * @OA\Get(
     *   path="/products",
     *   tags={"Products"},
     *   summary="Get all products",
     *   security={{"ApiKeyAuth": {}}},
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Product"))
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthorized"))
     *   )
     * )
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * @OA\Get(
     *   path="/products/{id}",
     *   tags={"Products"},
     *   summary="Get a single product by ID",
     *   security={{"ApiKeyAuth": {}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(ref="#/components/schemas/Product")
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Product not found",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Product not found"))
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthorized"))
     *   )
     * )
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    /**
     * @OA\Post(
     *   path="/products",
     *   tags={"Products"},
     *   summary="Create a new product",
     *   security={{"ApiKeyAuth": {}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Product")
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Product created",
     *     @OA\JsonContent(ref="#/components/schemas/Product")
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid input",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Invalid input"))
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthorized"))
     *   )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'brand' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'image' => 'nullable|string',
        ]);
        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    /**
     * @OA\Put(
     *   path="/products/{id}",
     *   tags={"Products"},
     *   summary="Update an existing product",
     *   security={{"ApiKeyAuth": {}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Product")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Product updated",
     *     @OA\JsonContent(ref="#/components/schemas/Product")
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Product not found",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Product not found"))
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid input",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Invalid input"))
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthorized"))
     *   )
     * )
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'stock' => 'nullable|integer',
            'brand' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'image' => 'nullable|string',
        ]);
        $product->update($validated);
        return response()->json($product);
    }

    /**
     * @OA\Delete(
     *   path="/products/{id}",
     *   tags={"Products"},
     *   summary="Delete a product",
     *   security={{"ApiKeyAuth": {}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Product deleted",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Product deleted"))
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Product not found",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Product not found"))
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthorized"))
     *   )
     * )
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}