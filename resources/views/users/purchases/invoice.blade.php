@extends('users.invoice_layout')
@section('user_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Purchase Invoice Details</h6>
        </div>
        <div class="card-body">

            <div class="row clearfix justify-content-md-center">
                <div class="col-md-6">
                    <div class="no_padding"><strong> Customer: </strong>{{ $user->name }}</div>
                    <div class="no_padding"><strong> Email: </strong>{{ $user->email }}</div>
                    <div class="no_padding"><strong> Phone: </strong>{{ $user->phone }}</div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="no_padding"><strong> Date: </strong> {{ $invoice->date }}</div>
                    <div class="no_padding"><strong> Challan No: </strong>{{ $invoice->challan_no }}</div>
                </div>
            </div>
            <div class="invoice_item mt-4 p-2">
                <div class="table-responsive">
                    <table class="table"  width="100%" cellspacing="0">
                        <thead>
                            <th>SL</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th class="text-right">Total</th>
                            <th class="text-right">Action</th>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($invoice->items as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->product->title }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-right">{{ $item->total }}</td>
                                <td class="text-right">
                                    <form method="POST" action="{{ route('user.purchase.delete_item', ['id' =>$user->id, 'invoice_id' => $invoice->id,'item_id'=>$item->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you Sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tr>
                            <th><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#newProduct"><i class="fa fa-plus"></i> Add Product</button></th>
                            <th colspan="2"></th>
                            <th class="text-right">Total:</th>
                            <th class="text-right">{{$totalPaid }}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newPaymentForInvoice"><i class="fa fa-plus"></i> Add Payment</button></th>
                            <th colspan="2"></th>
                            <th class="text-right">Total:</th>
                            <th class="text-right">{{$totalPayable}}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th class="text-right">Due:</th>
                            <th class="text-right">{{$totalPaid - $totalPayable }}</th>
                            <th></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>



    {{--    Modal for Add new Receipt for Invoice--}}

    <div class="modal fade" id="newPaymentForInvoice" tabindex="-1" aria-labelledby="newPaymentForInvoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => ['user.payments.store', [$user->id, $invoice->id] ], 'method' => 'post']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="newPaymentForInvoiceModalLabel">New Payment for this Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{Form::date('date', NULL,['class' => 'form-control', 'id' =>'Date', 'placeholder' => 'Date','required']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{Form::number('amount', NULL,['class' => 'form-control', 'id' =>'amount', 'placeholder' => 'Amount' ,'required']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-sm-3 col-form-label">Note</label>
                        <div class="col-sm-9">
                            {{Form::textarea('note', NULL,['class' => 'form-control',  'rows' =>'3', 'id' =>'note', 'placeholder' => 'Note']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    {{--    Modal for Add new Product--}}

    <!-- Modal -->
    <div class="modal fade" id="newProduct" tabindex="-1" aria-labelledby="newProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => ['user.purchase.add_item', ['id' => $user->id , 'invoice_id' => $invoice->id ]], 'method' => 'post']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="newProductModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="prducts" class="col-sm-3 col-form-label text-right">Products <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{Form::select('product_id', $products, NULL,['class' => 'form-control', 'id' =>'products','required', 'placeholder' => 'Select a Product'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-sm-3 col-form-label text-right">Unit Price <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{Form::number('price', NULL,['class' => 'form-control', 'id' =>'price','onkeyup'=>'getTotal()', 'required', 'placeholder' => 'Price']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quantity" class="col-sm-3 col-form-label text-right">Quantity <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{Form::number('quantity', NULL,['class' => 'form-control', 'id' =>'quantity','onkeyup'=>'getTotal()', 'required', 'placeholder' => 'Quantity']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="total" class="col-sm-3 col-form-label text-right">Total <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            {{Form::number('total', NULL,['class' => 'form-control', 'id' =>'total', 'required', 'placeholder' => 'Total']) }}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <script type="text/javascript">

        function getTotal() {
        var price = document.getElementById('price').value;
        var quantity = document.getElementById('quantity').value;
        
            if ( price && quantity) {
                var total = price * quantity;
                 document.getElementById('total').value = total;
                
            }
        }
        // var quantity = 

    </script>



@endsection
