@extends('users.user_layout')
@section('user_content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Receipts of <strong>{{ $user->name }}</strong> </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Admin</th>
                        <th>Date</th>
                        <th class="text-right">Total</th>
                        <th>Note</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total :</th>
                        <th class="text-right">{{ $user->receipts()->sum('amount') }}</th>

                        <th class="text-right"></th>
                        <th class="text-right"></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @php($id = 1)
                    @foreach($user->receipts as $receipt)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ optional($receipt->admin)->name }}</td>
                            <td>{{ $receipt->date }}</td>
                            <td class="text-right">{{ $receipt->amount }}</td>
                            <td>{{ $receipt->note }}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('user.receipts.destroy', ['id' =>$user->id, 'receipt_id'=>$receipt->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you Sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
