<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that should be mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'description', 'price', 'stock'];

    protected static function booted() {
        static::saving(function ($product) {
            $slug = Str::slug($product->name);
            $count = static::where('slug', 'LIKE', "{$slug}%")->count();

            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}
