<?php
namespace App\Services;

use App\Services\Service;
use App\Product;
use App\ProductAttribute;
use App\Transformers\ProductTransformer;
use Illuminate\Support\Facades\DB;

class ProductService extends Service
{
    private $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function saveProduct(array $data): Product
    {
        return DB::transaction(function() use ($data) {
            $product = $this->model->create($data);

            $attributes = $data['attributes'];
            
            if(count($attributes)) {
                $product->productAttributes()
                    ->saveMany(
                        array_map(function($attr) {
                            return new ProductAttribute($attr);
                        }, $attributes)
                    );
            }

            return $product->load('productAttributes');    
        });
    }

    public function updateProduct(Product $product, array $data): array
    {
        return DB::transaction(function() use ($product, $data) {
            $product->update($data);

            $attributes = $data['attributes'];
            
            if(count($attributes)) {

                $product->productAttributes()->delete();

                $product->productAttributes()
                    ->saveMany(
                        array_map(function($attr) {
                            return new ProductAttribute($attr);
                        }, $attributes)
                    );
            }

            return $product->load('productAttributes')->toArray();    
        });
    }

    public function getAll(): array
    {
        $products = $this->model->with('productAttributes')->get();
        $resource = fractal($products,  new ProductTransformer())->toArray();

        return $resource['data'];
    }

    public function findById(string $item): array
    {
        $product = $this->model->with('productAttributes')->find($item);
        $resource = fractal($product,  new ProductTransformer())->toArray();

        return $resource['data'];
    }
}