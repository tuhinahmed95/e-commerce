@extends('frontend.master')
@section('content')
<div class="row py-3">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Order Cancel Request</h3>
                <h4 class="d-inline-block bg-info text-white p-2">Order Id : <span class="bg-warning p-2">{{ $orders->order_id }}</span></h4>
            </div>
            <div class="card-body">
                <form action="{{ route('order.cancel.request',$orders->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Cancel Reson</label>
                        <textarea name="reson" class="form-control" cols="30" rows="10"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
