@extends('layout')
@section('title', 'Registration')
@section('content')
    <div class="container">
        <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
            @endif
            @if(session()->has('succes'))
                <div class="alert alert-succes">{{session()->get('succes')}}</div>
            @endif
        </div>
        <form action="{{route('registration.post')}}" method="POST" class="ms-auto, me-auto, mt-3" style="width: 500px">
            @csrf
            <div class="form-group">
                <label class="form-label">Gebruikersnaam : </label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Wachtwoord : </label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Registreren</button>
        </form>
    </div>
@endsection
