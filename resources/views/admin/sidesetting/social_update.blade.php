@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h1>Social Media Create</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('general.socialmedia.update',$social->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Icon Name</label>
                                <input type="text" class="form-control" name="icon_name" value="{{ $social->icon_name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Social Icon</label>
                                <input type="text" class="form-control" name="social_icon" value="{{ $social->social_icon }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label">Link</label>
                            <input type="text" class="form-control" name="link" value="{{ $social->link }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label">Color</label>
                            <input type="color" class="form-control" name="color" value="{{ $social->color }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
