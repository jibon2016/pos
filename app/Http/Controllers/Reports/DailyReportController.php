<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PurchaseItems;
use App\Models\Receipt;
use App\Models\SaleItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyReportController extends Controller
{

    public function __construct()
    {
        $this->data['main_manu'] = 'Reports';
        $this->data['sub_manu'] = 'Daily';
    }

    
    public function index(Request $request)
    {
        $this->data['start_date']   = $request->get('start_date', date('Y-m-d'));
        $this->data['end_date']     = $request->get('end_date', date('Y-m-d'));

        $this->data['sales'] = SaleItems::select( 'products.title', DB::raw('SUM(sale_items.quantity) as quantity, AVG(sale_items.price) as price, SUM(sale_items.total) as total') )
                                        ->join('products', 'sale_items.product_id', '=', 'products.id')
                                        ->join('sale_invoices', 'sale_items.sale_invoice_id', '=', 'sale_invoices.id')
                                        ->whereBetween('sale_invoices.date', [$this->data['start_date'], $this->data['end_date']])
                                        ->groupBy('products.title')
                                        ->get();

        $this->data['purchases'] = PurchaseItems::select( 'products.title', DB::raw('SUM(purchase_items.quantity) as quantity, AVG(purchase_items.price) as price, SUM(purchase_items.total) as total') )
                                        ->join('products', 'purchase_items.product_id', '=', 'products.id')
                                        ->join('purchase_invoices', 'purchase_items.purchase_invoice_id', '=', 'purchase_invoices.id')
                                        ->whereBetween('purchase_invoices.date', [$this->data['start_date'], $this->data['end_date']])
                                        ->where('has_stock' ,1)
                                        ->groupBy('products.title')
                                        ->get();

         $this->data['receipts'] = Receipt::select('users.name', DB::raw('users.name, SUM(receipts.amount) AS amount') )
                                         ->join('users', 'receipts.user_id', '=', 'users.id')
                                         ->whereBetween('date', [$this->data['start_date'], $this->data['end_date']])
                                         ->groupBy('users.name')
                                         ->get();


        $this->data['payments'] = Payment::select('users.name', DB::raw('users.name, SUM(payments.amount) AS amount') )
                                         ->join('users', 'payments.user_id', '=', 'users.id')
                                         ->whereBetween('date', [$this->data['start_date'], $this->data['end_date']])
                                         ->groupBy('users.name')
                                         ->get();
                                        

        return view('reports.daily', $this->data);
        
    }
}
