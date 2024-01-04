<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'image',
        'image_asset',
        'name',
        'slug',
        'description',

        'stock',

        'price_before',
        'price_after',
        'sold',

        'status',
    ];

    public function carts() {
        return $this->hasMany(Cart::class, 'product_id');
    }

    // public function users() {
    //     return $this->belongsToMany(User::class, 'carts', 'product_id', 'user_id');
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }



}
