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
        <H1>Add Employee</H1>
        <div class="row">

            {!! Form::open(['action' => 'EmployeeController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control" required>

            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" required>

            <label for="company">Company</label>
            <select name="company" id="company" class="form-control">
                @foreach($companies as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>

            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" required>

            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
            <br>
            <button class="btn btn-success" type="submit">Add Employee</button>
            {!! Form::close() !!}
        </div>
        <br>
        <br>
        <table id="Table_ID">
            <thead>
            <tr>
                <th>SN</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0?>
            @foreach($employees as $m)
                <?php $i++?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$m->fname}}</td>
                    <td>{{$m->lname}}</td>
                    <td>{{$m->email}}</td>
                    <td>{{$m->phone}}</td>
                    <td>{{$m->company['name']}}</td>
                    <td>
                        <a href="{{route('employee.edit',$m->id)}}">
                            <button class="btn btn-success">Edit</button>
                        </a>
                        <a href="{{route('employee.delete',$m->id)}}">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
