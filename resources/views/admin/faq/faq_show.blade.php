@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Single Faq List</h3>
                </div>
                <div class="card-header">
                    <table class="table table-bordered">
                            <tr>
                                <th>Sl</th>
                                <td>{{ $faq->id }}</td>
                            </tr>
                            <tr>
                                <th>Question</th>
                                <td>{{ $faq->question }}</td>
                            </tr>
                            <tr>
                                <th>Answer</th>
                                <td>{{ $faq->answer }}</td>
                            </tr>
                    </table>
                    <a href="{{ route('faq.index') }}" class="btn btn-primary mt-2">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
