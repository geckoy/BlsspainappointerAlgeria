@extends('layout.app')

@section('path', $path)

@section('add_new')
        @if (session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
        @endif
    <h4 style="color: red;">Warning The FIle sould be in CSV Format.
    </h4>
    
    <p>the form should take : </p>
    <p>email,password,bls_password</p>
    <p>jump line for each account</p>
    <br />
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="checkersfile">
        <input type="submit" name="submit" value="Submit File">
    </form>
    <br />
@endsection