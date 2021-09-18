@extends('layout.main')

@section('main_contant')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>{{ $headline }}</h2>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $headline }}</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-10">
                    @if($mode == 'edit')
                        {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'put']) !!}
                    @else
                        {!! Form::open(['route' => 'products.store', 'method' => 'post']) !!}
                    @endif

                    <div class="form-group row">
                        <label for="title" class="col-sm-1 text-right col-form-label">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            {{Form::text('title', NULL,['class' => 'form-control', 'id' =>'title', 'placeholder' => 'Title']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-1 text-right col-form-label">Description</label>
                        <div class="col-sm-10">
                            {{Form::textarea('description', NULL,['class' => 'form-control', 'id' =>'description', 'placeholder' => 'Description']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-sm-1 text-right col-form-label">Categories<span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            {{Form::select('category_id', $category, NULL,['class' => 'form-control', 'id' =>'Category', 'placeholder' => 'Select a Category'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cost_price" class="col-sm-1 text-right col-form-label">Cost Price <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            {{Form::number('cost_price', NULL,['class' => 'form-control', 'id' =>'cost_price', 'placeholder' => 'Cost Price']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-sm-1 text-right col-form-label">Sale Price <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            {{Form::number('price', NULL,['class' => 'form-control', 'id' =>'price', 'placeholder' => 'Sale Price']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-sm-1 text-right col-form-label">Has Stock<span class="text-danger">*</span></label>
                        <div class="col-sm-2">
                            {{Form::select('has_stock', ['1' => 'Yes', '0'=>'No'], NULL,['class' => 'form-control', 'id' =>'Category',])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-1 text-right col-form-label"></label>
                        <div class="col-sm-5 mt-3" >
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </div>

                    <div class="text-right">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

