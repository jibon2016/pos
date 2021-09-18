<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'name', 'phone','email', 'address'];

    public function group(){

        return $this->belongsTo(Group::class);
    }

    public function sales(){
        return $this->hasMany(SaleInvoice::class);
    }

    // Sales Items of a User
    public function SalesItems()
    {
        return $this->hasManyThrough(SaleItems::class, SaleInvoice::class);
    }

    public function purchases(){
        return $this->hasMany(PurchaseInvoice::class);
    }

    // Purchase Items of a User
    public function PurchasesItems()
    {
        return $this->hasManyThrough(PurchaseItems::class, PurchaseInvoice::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function receipts(){
        return $this->hasMany(Receipt::class);
    }
}
