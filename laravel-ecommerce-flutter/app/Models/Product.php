<?php

namespace App\Models;
use App\Models\Order;
use App\Models\Checkout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'price',
        'img',
        'category_id',
        'rat',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function checkout(){
        return $this->belongsTo(Checkout::class);
    }
}
