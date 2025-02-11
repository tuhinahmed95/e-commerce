@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Cancel Order List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Order Id</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($order_cancel_list as $key=> $cancel_list )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ App\Models\Order::find($cancel_list->order_id)->order_id }}</td>
                        <td>
                            <a href="{{ route('order.cancel.details',$cancel_list->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('order.cancel.accept',$cancel_list->id) }}" class="btn btn-danger">Accept</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
