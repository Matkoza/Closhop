<?php
/**
 * @OA\Post(path="/admin/products", tags={"products"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Adding a product", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="title", required="true", type="string", example="Cheesecake",	description="Title of the product" ),
 *    				 @OA\Property(property="time_req", required="true", type="string", example="1 hour",	description="Time for the product" ),
 *    				 @OA\Property(property="procedure", required="true", type="string", example="Prepare a baking dish...",	description="Procedure the the product" ),
 *    				 @OA\Property(property="ingredients", required="true", type="string", example="100g of cream cheese...",	description="Ingredients for the product" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="product added.")
 * )
 */
Flight::route('POST /admin/products', function(){
 $data = Flight::request()->data->getData();
 Flight::productService()->add_product($data);
});

/**
 * @OA\Get(path="/admin/products", tags={"products"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for products. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List products from database")
 * )
 */
Flight::route('GET /admin/products', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::productService()->get_products($search, $offset, $limit, $order, TRUE);
  header('total-products: ' . $total['total']);
  Flight::json(Flight::productService()->get_products($search, $offset, $limit, $order));
});

/**
 * @OA\Get(path="/admin/products/{id}", tags={"products"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1, description="Id of product"),
 *     @OA\Response(response="200", description="Fetch individual product")
 * )
 */
Flight::route('GET /admin/products/@id', function($id){
  Flight::json(Flight::productService()->get_by_id($id));
});

/**
 * @OA\Get(path="/admin/products/", tags={"products"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="Fetch based on gender")
 * )
 */
 Flight::route('GET /admin/maleproducts', function(){
  Flight::json(Flight::productService()->get_male_products());
});
?>
