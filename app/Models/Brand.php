<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model 
{
    protected $table = 'brands';

    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function products() {
        return $this->hasMany( Product::class );
    }
}
