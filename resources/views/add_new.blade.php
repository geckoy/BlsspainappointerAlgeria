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
    <h4 style="color: red;">Warning The FIle sould be in CSV Format each personal 
        should have his own csv, More than one person in one csv 
        it'll be counted as FAMILLY!!
    </h4>
    
    <p>the form should take : </p>
    <p>FamilyName, firstName, passportN°, bornDate(YYYY-MM-DD), PhoneNumber, gmail-address, password, passportSub(YYYY-MM-DD), passportExp(YYYY-MM-DD), passportIssuePlace</p>
    <h6>For Other family memebers should not contain phone and gmail && password because only the first person's data we'll be used for others</h6>
    <br />
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="applicantfile">
        <input type="submit" name="submit" value="Submit File">
    </form>
    <br />
@endsection