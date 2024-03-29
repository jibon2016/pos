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
                <div class="col-md-6">
                    @if(isset($user))
                        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                    @else
                        {!! Form::open(['route' => 'users.store', 'method' => 'post']) !!}
                    @endif
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">User Group <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                {{Form::select('group_id', $groups, NULL,['class' => 'form-control', 'id' =>'group', 'placeholder' => 'Select a Group'])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                {{Form::text('name', NULL,['class' => 'form-control', 'id' =>'name', 'placeholder' => 'Name']) }}
                            </div>
                        </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            {{Form::email('email', NULL,['class' => 'form-control', 'id' =>'email', 'placeholder' => 'Email']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            {{Form::number('phone', NULL,['class' => 'form-control', 'id' =>'phone', 'placeholder' => 'Phone']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            {{Form::text('address', NULL,['class' => 'form-control', 'id' =>'address', 'placeholder' => 'Address']) }}
                        </div>
                    </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

