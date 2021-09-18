<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'cost_price', 'price','category_id','has_stock'];

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function purchsasesItems()
    {
        return $this->hasMany(PurchaseItems::class);
    }


    public function saleItems()
    {
        return $this->hasMany(SaleItems::class);
    }


    public static function arrayForSelect()
    {
        $arr = [];
        $products = Product::all();
        foreach ($products as $product){
            $arr['products'][$product->id] = $product->title;
        }
        return $arr;
    }
}
