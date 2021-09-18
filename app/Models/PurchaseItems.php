<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItems extends Model
{
    use HasFactory;

    protected $fillable =['product_id','purchase_invoice_id','quantity', 'price', 'total'];

    public function invoice(){
        return $this->belongsTo(PurchaseInvoice::class);
    }
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
