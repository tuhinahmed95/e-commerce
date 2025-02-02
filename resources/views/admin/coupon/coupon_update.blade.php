@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3>Update Coupon</h3>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('cupon.list') }}" class="btn btn-primary mr-3">Back To List</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('cupon.update',$cupon->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Coupon</label>
                            <input type="text" name="cupon" class="form-control" value="{{ $cupon->coupon }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Coupon Type</label>
                            <select name="type" id="" class="form-control">
                                <option value="">Select Coupon Type</option>

                                    <option value="1">Percentage</option>
                                    <option value="2">Solid</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" value="{{ $cupon->amount }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Validity</label>
                            <input type="date" name="validity" class="form-control" value="{{ $cupon->validity }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Limit</label>
                            <input type="number" name="limit" class="form-control" value="{{ $cupon->limit }}">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
