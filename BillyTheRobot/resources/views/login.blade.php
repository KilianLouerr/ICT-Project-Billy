@extends('layout')
@section('title', 'Login')
@section('content')
<section>
    <h2>Login Beheerder</h2>
</section>
<section>
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
    <div class="flex-space-around">
        <form action="{{route('login.post')}}" method="POST">
            @csrf
            <div id="login">
                <label>Email</label>
                <input type="text" name="name">
                <label class="form-label">Wachtwoord</label>
                <input type="password" name="password">
                <button type="submit">Log in</button>
            </div>
        </form>
    </div>
</section>
@endsection
