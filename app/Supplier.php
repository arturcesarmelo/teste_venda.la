<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Supplier extends Model {

    use Uuid, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public static function rules(): array
    {
        return [
            'name'=>'required|max:100'
        ];
    }
}