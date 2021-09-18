@extends('layout.main')

@section('main_contant')
    <div class="row clearfix page_header">
        <div class="col-md-6">
            <div class="dropdown mr-5">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter By Group
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('users.index') }}">All User</a>
                 @foreach ($gorups as $gorup)
                    <a class="dropdown-item" href="{{ route('users.index') }}?group={{$gorup->id}} ">{{ $gorup->title}}</a>
                 @endforeach
                </div>
              </div>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ url('users/create') }}" class="btn btn-info"><i class="fa fa-plus"></i> New User</a>   
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordeless table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th class="text-right">Sales</th>
                        <th class="text-right">Purchases</th>
                        <th class="text-right">Receipts</th>
                        <th class="text-right">Payment</th>
                        <th class="text-right">Balance</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php($id = 1)
                        <?php
                            $totalSale      = 0;
                            $totalPurchase  = 0;
                            $totalReceipt   = 0;
                            $totalPayment   = 0;
                            $totalBlance    = 0;
                        ?>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ optional($user->group)->title }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td class="text-right">
                                <?php 
                                    $sale = $user->SalesItems()->sum('total');
                                    $totalSale += $sale;
                                    echo number_format($sale, 2);
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                    $purchase = $user->PurchasesItems()->sum('total');
                                    $totalPurchase += $purchase;
                                    echo number_format($purchase, 2);
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                    $receipt =  $user->receipts()->sum('amount');
                                    $totalReceipt += $receipt;
                                    echo number_format($receipt, 2);
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                    $payment =  $user->payments()->sum('amount');
                                    $totalPayment += $payment;
                                    echo number_format($payment, 2);
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                    $blance = ($purchase + $receipt) - ($sale +  $payment);
                                    $totalBlance += $blance;
                                    echo number_format($blance, 2);                                             
                                ?>
                            </td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('users.destroy', ['user' =>$user->id]) }}">
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.show',['user' => $user->id]) }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit',['user' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                                    @if (
                                        $user->sales()->count() == 0 
                                        && $user->purchases()->count() == 0 
                                        && $user->receipts()->count() == 0 
                                        && $user->payments()->count() == 0 
                                        )
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you Sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Group</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th class="text-right">{{ number_format($totalSale, 2) }}</th>
                            <th class="text-right">{{ number_format($totalPurchase, 2) }}</th>
                            <th class="text-right">{{ number_format($totalReceipt, 2) }}</th>
                            <th class="text-right">{{ number_format($totalPayment, 2) }}</th>
                            <th class="text-right">{{ number_format($totalBlance, 2) }}</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
