@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Cancel Order Details</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('order.cancel.list') }}" class="btn btn-success mr-3">Back To Order Cancel List</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID : </th>
                        <td>{{ App\Models\Order::find($cancel_order_detaisl->order_id)->order_id}}</td>
                    </tr>

                    <tr>
                        <th>Reson : </th>
                        <td>{{ $cancel_order_detaisl->reson }}</td>
                    </tr>

                    <tr>
                        <th>Image : </th>
                        <td><img src="{{ asset('uploads/cancelorder') }}/{{ $cancel_order_detaisl->image }}" alt=""></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

