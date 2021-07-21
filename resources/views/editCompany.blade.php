@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <H1>Add Company</H1>
        <div class="row">

            {!! Form::open(['action' => ['CompanyController@update',$company->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <label for="name">Company Name</label>
            <input type="text" name="name" class="form-control" required value="{{$company->name}}">

            <label for="website">Website</label>
            <input type="text" name="website" class="form-control" required value="{{$company->website}}">

            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required value="{{$company->email}}">

            <label for="logo">Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/*" required>
            <br>
            <button class="btn btn-success" type="submit">Update Company</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
