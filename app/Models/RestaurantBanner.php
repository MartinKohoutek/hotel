<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantBanner extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(MenuCategory::class, 'category_id', 'id');
    }
}
