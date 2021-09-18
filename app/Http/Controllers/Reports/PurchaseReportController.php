<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\PurchaseItems;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    
    public function __construct()
    {
        $this->data['main_manu'] = 'Reports';
        $this->data['sub_manu'] = 'Purchases';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['start_date']   = $request->get('start_date', date('Y-m-d'));
        $this->data['end_date']     = $request->get('end_date', date('Y-m-d'));

        $this->data['purchases'] = PurchaseItems::select('purchase_items.quantity', 'purchase_items.price', 'purchase_items.total', 'products.title', 'purchase_invoices.challan_no', 'purchase_invoices.date')
                                        ->join('products', 'purchase_items.product_id', '=', 'products.id')
                                        ->join('purchase_invoices', 'purchase_items.purchase_invoice_id', '=', 'purchase_invoices.id')
                                        ->whereBetween('purchase_invoices.date', [$this->data['start_date'], $this->data['end_date']])
                                        ->get();

        return view('reports.purchase', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
