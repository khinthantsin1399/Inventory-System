<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model 
{
    use SoftDeletes;

    protected $table = 'products';

    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'code',
        'category_id',
        'brand_id',
        'price',
        'quantity',
        'image',
        'description',
    ];

    protected $appends = [
        'category_name',
        'brand_name',
    ];

    public function category() {
        return $this->belongsTo( Category::class );
    }

    public function brand() {
        return $this->belongsTo( Brand::class );
    }

    public function getCategoryNameAttribute() {
        return $this->category ? $this->category->name : null;
    }

    public function getBrandNameAttribute() {
        return $this->brand ? $this->brand->name : null;
    }
}
