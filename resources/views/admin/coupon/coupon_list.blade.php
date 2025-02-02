@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Coupon List</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('cupon.create') }}" class="btn btn-primary mr-2">Add New Coupon</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Coupon</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Validity</th>
                            <th>Limit</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($cupons as $key => $cupon )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $cupon->coupon }}</td>
                            <td>{{ $cupon->type==1?'percentage':'solid' }}</td>
                            <td>{{ $cupon->amount }}</td>
                            <td>{{ $cupon->validity }}</td>
                            <td>{{ $cupon->limit }}</td>
                            <td><a href="{{ route('cupon.status',$cupon->id) }}" class="btn btn-{{ $cupon->status ==1?'success':'secondary' }}">{{ $cupon->status ==1?'Active':'Inactive' }}</a></td>
                            <td>
                                <a href="{{ route('cupon.edit',$cupon->id) }}" class="btn btn-warning icon"><i data-feather="edit"></i></a>
                                <a href="{{ route('cupon.delete',$cupon->id) }}" class="btn btn-danger icon"><i data-feather="trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
