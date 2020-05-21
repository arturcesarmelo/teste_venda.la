<?php

namespace App\Transformers;

use App\Product;
use League\Fractal;

class ProductTransformer extends Fractal\TransformerAbstract {

    public function transform(Product $product)
	{
	    return [
	        'id'            => $product->id,
	        'name'          => $product->name,
            'descfription'  => $product->descript,
            'price'         => $product->price,
            'price_tag'     => $product->price_tag,
            'attributes'    => $this->serializeAttributes($product->productAttributes->all()),
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/products/'.$product->id,
                ]
            ],
	    ];
    }
    
    private function serializeAttributes(array $attributes) {
        return array_map(function($attribute) {
            return ['name' => $attribute->name, 'value' => $attribute->value];
        }, $attributes);
    }

}