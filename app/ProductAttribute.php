<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Traits\Uuid;

class ProductAttribute extends Model {

    use Uuid;

    protected $fillable = [
        'name',
        'value',
        'product_id'
    ];

    public function Product() {
        return $this->belongsTo(Product::class);
    }
}