<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid {

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getKeyType()
    {
        return 'string';
    }
}