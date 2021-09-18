<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\SaleItems;
use Illuminate\Http\Request;

class SallesReportController extends Controller
{

    public function __construct()
    {
        $this->data['main_manu'] = 'Reports';
        $this->data['sub_manu'] = 'Sales';
    }
    /**
     * Display a listing of the resource.
    
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['start_date']   = $request->get('start_date', date('Y-m-d'));
        $this->data['end_date']     = $request->get('end_date', date('Y-m-d'));

        $this->data['sales'] = SaleItems::select('sale_items.quantity', 'sale_items.price', 'sale_items.total', 'products.title', 'sale_invoices.challan_no', 'sale_invoices.date')
                                        ->join('products', 'sale_items.product_id', '=', 'products.id')
                                        ->join('sale_invoices', 'sale_items.sale_invoice_id', '=', 'sale_invoices.id')
                                        ->whereBetween('sale_invoices.date', [$this->data['start_date'], $this->data['end_date']])
                                        ->get();

        return view('reports.sales', $this->data);
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
