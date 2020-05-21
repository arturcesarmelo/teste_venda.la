<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Product;

class ProductController extends Controller
{

    private $service;

    public function __construct(ProductService $service) {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function store(Request $request)
    {

        $this->validate($request, Product::rules());
        
        try {

            $product = $this->service->saveProduct($request->all());

            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['message'=>'Product could not be created!'], 500);
        }
    }
    
    public function update($id, Request $request)
    {

        $this->validate($request, Product::rules());

        try {

            $product = Product::find($id);
            
            if (!$product)
                return response()->json(['message'=> "Product with ID: {$id} could not be found"], 404);
            
            $product = $this->service->updateProduct($product, $request->all());

            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['message'=>'Product could not be updated!'], 500);
        }
    }

    public function index() {
        $products = $this->service->getAll();
        return response()->json(compact('products'), 200);
    }

    public function show($id) {
        $product = $this->service->findById($id);
        
        if (!$product)
            return response()->json(['message'=> "Product with ID: {$id} could not be found"], 404);
        
        return response()->json($product, 200);
    }
    
    public function destroy($id) {
        $product = Product::find($id);
        
        if (!$product)
            return response()->json(['message'=> "Product with ID: {$id} could not be found"], 404);
        
        $product->delete();
    }
}
