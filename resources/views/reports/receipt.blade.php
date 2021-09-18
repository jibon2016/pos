@extends('layout.main')

@section('main_contant')
    <div class="row clearfix page_header">
        <div class="col-md-4">
            <h1>Receipt Reports</h1>
        </div>
        <div class="col-md-8">
          {!! Form::open(['route' => 'reports.receipt', 'method' => 'get']) !!}
            <div class="form-row align-items-center">
              <div class="col-auto">
                <label class="sr-only" for="inlineFormInput">Start Date</label>
                {{Form::date('start_date', $start_date,['class' => 'form-control', 'id' =>'date', 'placeholder' => 'Start Date']) }}
              </div>
              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">End Date</label>
                <div class="input-group mb-2">
                  {{Form::date('end_date', $end_date,['class' => 'form-control', 'id' =>'date', 'placeholder' => 'End Date']) }}
                </div>
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
              </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Receipt Report from <strong>{{$start_date }}</strong> to <strong>{{$start_date }}</strong></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th  class="text-right">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($id = 1)
                    @foreach($receipts as $receipt)
                        <tr>
                            <td>{{ $receipt->date }}</td>
                            <td>{{ optional($receipt->user)->name }}</td>
                            <td  class="text-right">{{ $receipt->amount }}</td>
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="2" class="text-right">Total</th>
                        <th  class="text-right">{{ $receipts->sum('amount')}}</th>
                      </tr>
                      </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
