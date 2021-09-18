
    <div class="row clearfix mt-5">
      <div class="col-md-2 mt-1">
          <div class="nav flex-column nav-pills">
              <a class="nav-link {{ $tab_menu == 'user_info' ? 'active' :'' }}" href="{{ route('users.show',$user->id   ) }}">User Info</a>
              <a class="nav-link  {{ $tab_menu == 'reports' ? 'active' :'' }}" href="{{ route('user.reports', $user->id) }}">Reports</a>
              <a class="nav-link  {{ $tab_menu == 'sales' ? 'active' :'' }}" href="{{ route('user.sales', $user->id) }}">Sales</a>
              <a class="nav-link  {{ $tab_menu == 'purchases' ? 'active' :'' }}" href="{{ route('user.purchases', $user->id)}} ">Purchase</a>
              <a class="nav-link {{ $tab_menu == 'payments' ? 'active' :'' }}" href="{{ route('user.payments', $user->id)}} ">Payment</a>
              <a class="nav-link {{ $tab_menu == 'receipts' ? 'active' :'' }}" href="{{ route('user.receipts', $user->id)}} ">Receipt</a>
          </div>
      </div>



      <div class="col-md-10">
         @yield('user_content')
      </div>

  </div>






  {{--    Modal for Add new Payment--}}

  <!-- Modal -->
  <div class="modal fade" id="newPayment" tabindex="-1" aria-labelledby="newPaymentModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              {!! Form::open(['route' => ['user.payments.store', $user->id], 'method' => 'post']) !!}
              <div class="modal-header">
                  <h5 class="modal-title" id="newPaymentModalLabel">New Payment</h5>
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


  {{--    Modal for Add new Receipt--}}

  <!-- Modal -->
  <div class="modal fade" id="newReceipt" tabindex="-1" aria-labelledby="newReceiptModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              {!! Form::open(['route' => ['user.receipts.store', $user->id], 'method' => 'post']) !!}
              <div class="modal-header">
                  <h5 class="modal-title" id="newReceiptModalLabel">New Receipt</h5>
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


  {{--    Modal for Add new Sale--}}

  <!-- Modal -->
  <div class="modal fade" id="newSale" tabindex="-1" aria-labelledby="newSaleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              {!! Form::open(['route' => ['user.sales.store', $user->id], 'method' => 'post']) !!}
              <div class="modal-header">
                  <h5 class="modal-title" id="newSaleModalLabel">New Sale Invoice</h5>
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
                      <label for="challan_no" class="col-sm-3 col-form-label">Challan Number </label>
                      <div class="col-sm-9">
                          {{Form::text('challan_no', NULL,['class' => 'form-control', 'id' =>'challan_no', 'placeholder' => 'Challan Number']) }}
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


  {{--    Modal for Add new Purchase--}}

  <!-- Modal -->
  <div class="modal fade" id="newPurchase" tabindex="-1" aria-labelledby="newPurchaseModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              {!! Form::open(['route' => ['user.purchase.store', $user->id], 'method' => 'post']) !!}
              <div class="modal-header">
                  <h5 class="modal-title" id="newPurchaseModalLabel">New Purchase Invoice</h5>
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
                      <label for="challan_no" class="col-sm-3 col-form-label">Challan Number </label>
                      <div class="col-sm-9">
                          {{Form::text('challan_no', NULL,['class' => 'form-control', 'id' =>'challan_no', 'placeholder' => 'Challan Number']) }}
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
