@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3> Add New Faq </h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('faq.index') }}" class="btn btn-primary mr-3">Faq Manage</a>
                </div>
                <div class="card-header">
                    <form action="{{ route('faq.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Question</label>
                            <input type="text" class="form-control" name="question">
                            @error('question')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Answer</label>
                            <textarea name="answer" id="" cols="30" rows="5" class="form-control"></textarea>
                            @error('answer')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Faq</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
