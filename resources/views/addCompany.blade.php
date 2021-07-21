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
       <H1>Add Company</H1>  <!-- creating form for adding company -->
        <div class="row">

            {!! Form::open(['action' => 'CompanyController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <label for="name">Company Name</label>
            <input type="text" name="name" class="form-control" required> <!-- required is for input must be fiiled up in form -->

            <label for="website">Website</label>
            <input type="text" name="website" class="form-control" required> <!-- required also known as validation -->

            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>

            <label for="logo">Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/*" required> <!-- accept="image/*" means accept all the type of image file -->
            <br>
            <button class="btn btn-success" type="submit">Add Company</button>
            {!! Form::close() !!}
        </div>
        <br>
        <br> <!-- this table is created to display the user input after adding company -->
        <table id="Table_ID">
            <thead>
            <tr>
                <th>SN</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Website</th>
                <th>Logo</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0?>
            @foreach($companies as $m)
                <?php $i++?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$m->name}}</td>
                    <td>{{$m->email}}</td>
                    <td>{{$m->website}}</td>
                    <td><img src="logos/{{$m->logo}}" width="20px" height="20px"></td>
                    <td>
                        <a href="{{route('company.edit',$m->id)}}"><button class="btn btn-success">Edit</button></a>
                        <a href="{{route('company.delete',$m->id)}}"><button class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection