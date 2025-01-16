@extends('layouts.admin')
@section('content')

<h3>Welcome To Dashboard</h3> <strong class="text-primary">{{ Auth::user()->name }}</strong>

@endsection
