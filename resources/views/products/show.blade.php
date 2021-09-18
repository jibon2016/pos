@extends('layout.main')

@section('main_contant')
    <div class="row clearfix page_header">
        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> {{ $product->title }}</h6>
        </div>
        <div class="card-body">

            <div class="row clearfix justify-content-md-center">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th class="text-right">Title :</th>
                                <td>{{ $product->title }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Description </th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Category :</th>
                                <td>{{ $product->category->title }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Cost Price :</th>
                                <td>{{ $product->cost_price }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Sale Price :</th>
                                <td>{{ $product->price   }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
