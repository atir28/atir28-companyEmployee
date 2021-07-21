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
        <H1>Edit Employee</H1>
        <div class="row">

            {!! Form::open(['action' => ['EmployeeController@update',$employe->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control" required value="{{$employe->fname}}">

            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" required value="{{$employe->lname}}">

            <label for="company">Company</label>
            <select name="company" id="company" class="form-control">
                @foreach($companies as $c)
                    <option value="{{$c->id}}" {!! old('company_id',$employe->company_id) == $c->id ? 'selected="selected"':''!!}>{{$c->name}}</option>
                @endforeach
            </select>

            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" required value="{{$employe->phone}}">

            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required value="{{$employe->email}}">
            <br>
            <button class="btn btn-success" type="submit">Update Employee</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
