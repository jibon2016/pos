@extends('layout.main')

@section('main_contant')
    <div class="row clearfix page_header">
        <div class="col-md-4">
            <a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="col-md-8 text-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newSale">
                <i class="fa fa-plus"></i> New Sale
            </button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newPurchase">
                <i class="fa fa-plus"></i> New Purchase
            </button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newPayment">
                <i class="fa fa-plus"></i> New Payment
            </button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newReceipt">
                <i class="fa fa-plus"></i> New Receipt
            </button>
        </div>
    </div>

    
    @yield('user_card')

    @include('users.user_layout_content')

@endsection

