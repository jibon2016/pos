<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceProductRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseItems;
use App\Models\SaleInvoice;
use App\Models\SaleItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserPurchasesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['tab_menu'] = 'purchases';
    }

    public function index($id)
    {
        $this->data['user']            = User::findOrFail($id);
        return view('users.purchases.purchases', $this->data);
    }


    public function createInvoice(InvoiceRequest $request, $user_id)
    {
        $formData               = $request->all();
        $formData['user_id']    = $user_id;
        $formData['admin_id']   = Auth::id();

        if ($invoice = PurchaseInvoice::create($formData)){


        }

            return redirect()->route('user.purchase.invoice_details', ['id' => $user_id, 'invoice_id' => $invoice->id]);
    }



    public function invoice($user_id, $invoice_id)
    {
        $this->data['user']         = User::findOrFail($user_id);
        $this->data['invoice']      = PurchaseInvoice::findOrFail($invoice_id);
        $this->data['totalPaid']    = $this->data['invoice']->items->sum('total');
        $this->data['totalPayable'] = $this->data['invoice']->payments()->sum('amount');
        $this->data['products']     = Product::arrayForSelect();

        return view('users.purchases.invoice', $this->data);
    }




    public function addItem(InvoiceProductRequest $request, $user_id, $invoice_id)
    {
        $formData                           = $request->all();
        $formData['purchase_invoice_id']    = $invoice_id;

        if (PurchaseItems::create($formData)) {
            Session::flash('success_message', 'Item add Successfully');
        };
        return redirect()->route('user.purchase.invoice_details', ['id' => $user_id, 'invoice_id' => $invoice_id]);
    }




    public function destroyItem($user_id, $invoice_id, $item_id)
    {
        if (PurchaseItems::destroy($item_id)) {
            Session::flash('success_message', 'Item Delete Successfully');
        };
        return redirect()->route('user.purchase.invoice_details', ['id' => $user_id, 'invoice_id' => $invoice_id]);
    }



    public function destroy($user_id, $invoice_id)
    {
        if (PurchaseInvoice::destroy($invoice_id)) {
            Session::flash('success_message', 'Invoice deleted Successfully');
        };
        return redirect()->route('user.purchases', ['id' => $user_id]);
    }
}
