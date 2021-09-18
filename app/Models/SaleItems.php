<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItems extends Model
{
    use HasFactory;

    protected $fillable =['product_id','sale_invoice_id','quantity', 'price', 'total'];

    public function invoice(){
        return $this->belongsTo(SaleInvoice::class, 'sale_invoice_id', 'id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
