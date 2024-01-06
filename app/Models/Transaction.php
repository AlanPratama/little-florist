<?php

namespace App\Models;

use App\Http\Controllers\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'product_id',
        'message',
        'address',
        'total_product',
        'total_price',
        'date',
        'date_end',
        'actualDateEnd',
        'status',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
