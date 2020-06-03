<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;
use App\ProductAttribute;
use App\Traits\Uuid;

class Product extends Model {

    use Uuid;

    protected $fillable = [
        'name',
        'description',
        'price',
        'barcode',
        'supplier_id'
    ];

    protected $appends = ['price_tag'];

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public static function rules() {
        return [
            'name' => 'bail|required|string|max:255',
            'price' => 'bail|required|integer',
            'barcode' => 'bail|required|string',
            'supplier_id'=> 'bail|required|uuid'
        ];
    }

    public function getPriceTagAttribute()
    {
        $price = $this->attributes['price'];
        return formatMoney($price);
    }
}
