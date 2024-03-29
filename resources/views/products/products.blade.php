@extends('layout.main')

@section('main_contant')
    <div class="row clearfix page_header">
        <div class="col-md-6">
            <h1>Products</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('products.create') }}" class="btn btn-info"><i class="fa fa-plus"></i> New Product</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Products</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Cost Price</th>
                        <th>Sale Price</th>
                        <th>Has Stock</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Cost Price</th>
                        <th>Sale Price</th>
                        <th>Has Stock</th>
                        <th class="text-right" >Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @php($id = 1)
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $product->category->title }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->cost_price }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ ($product->has_stock ==1) ? 'Yes' : 'No'  }}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('products.destroy', ['product' =>$product->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-sm" href="{{ route('products.show',['product' => $product->id]) }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('products.edit',['product' => $product->id]) }}"><i class="fa fa-edit"></i></a>
                                    <button onclick="return confirm('Are you Sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
