@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Offer 1</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('offer1.update',$offer->first()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="aaa" class="form-label">Title</label>
                        <input type="text" id="aaa" class="form-control" name="title" value="{{ $offer->first()->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="{{ $offer->first()->price }}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price" value="{{$offer->first()->discount_price }}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img width="200" id="blah" src="{{ asset('uploads/offer') }}/{{ $offer->first()->image }}" alt="">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" value="{{ $offer->first()->date }}">
                    </div>

                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary">Update Offer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Offer 2</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('offer2.update',$offer2->first()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $offer2->first()->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="aaa" class="form-label">Subtitle</label>
                        <input type="text" id="aaa" class="form-control" name="subtitle" value="{{ $offer2->first()->subtitle }}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img width="200" id="blah" src="{{ asset('uploads/offer') }}/{{ $offer2->first()->image }}" alt="">
                        </div>
                    </div>

                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary">Update Offer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
