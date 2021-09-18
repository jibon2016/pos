@extends('users.user_layout')
@section('user_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Purchases of <strong>{{ $user->name }}</strong> </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Challan_no</th>
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
                    @foreach($user->purchases as $purchase)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $purchase->challan_no }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $purchase->date }}</td>
                            <td class="text-right">
                                <?php
                                    $itemQty = $purchase->items->sum('quantity');
                                    $totalItem += $itemQty;
                                    echo $itemQty
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                $total = $purchase->items->sum('total');
                                $grandTotal += $total;
                                echo $total;
                                ?>
                            </td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('user.purchase.delete',['id' => $user->id, 'invoice_id'=> $purchase->id ]) }}">
                                    <a class="btn btn-primary btn-sm" href="{{  route('user.purchase.invoice_details',['id' => $user->id, 'invoice_id'=> $purchase->id ])}}"><i class="fa fa-eye"></i></a>
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
                            <th>Challan_no</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th class="text-right">{{ $totalItem }}</th>
                            <th class="text-right">{{ $grandTotal }}</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </tfoot>
                </table>
            </div>

        </div>
    </div>
@endsection
