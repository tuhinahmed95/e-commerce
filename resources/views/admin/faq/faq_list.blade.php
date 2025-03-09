@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Faq List</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('faq.create') }}" class="btn btn-primary mr-3">Add Faq</a>
                </div>
                <div class="card-header">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $key=> $faq)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->answer }}</td>
                                <td class="d-flex mr-1">
                                    <a href="{{ route('faq.show',$faq->id) }}" class="btn btn-warning mr-2">View</a>
                                    <a href="{{ route('faq.edit',$faq->id) }}" class="btn btn-primary mr-2">Edit</a>
                                    <form action="{{ route('faq.destroy',$faq->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
