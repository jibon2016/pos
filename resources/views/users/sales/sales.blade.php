@extends('users.user_layout')
@section('user_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sales of <strong>{{ $user->name }}</strong> </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Challan no</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                        $grandTotal = 0;
                        $totalItem = 0;
                    ?>

                    @php($id = 1)
                    @foreach($user->sales as $sale)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $sale->challan_no }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $sale->date }}</td>
                            <td>
                                <?php
                                    $itemQty = $sale->items->sum('quantity');
                                    $totalItem += $itemQty;
                                    echo $itemQty
                                ?>
                            </td>
                            <td>
                                <?php
                                $total = $sale->items->sum('total');
                                $grandTotal += $total;
                                echo $total;
                                ?>
                            </td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('user.sales.invoice_details',['id' => $user->id, 'invoice_id'=> $sale->id ]) }}">
                                    <a class="btn btn-primary btn-sm" href="{{ route('user.sales.delete',['id' => $user->id, 'invoice_id'=> $sale->id ]) }}"><i class="fa fa-eye"></i></a>
                                    @if ($itemQty == 0)
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
                        <th>Challan no</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>{{ $totalItem }}</th>
                        <th>{{ $grandTotal }}</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
    @endsection
