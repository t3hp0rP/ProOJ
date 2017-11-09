@extends('layouts.app')

@section('content')
    <div class="container">
        @include('message')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <span style="font-size: 20px">
                    Please activate your account in your email!
                    <a href="{{ url('resendMail',['uid' => $uid]) }}">Send again?</a>
                </span>
                <img src="{{ asset('img/e4f1ec0d4e4c5c9eed3658b25cc1c7b3.jpg') }}" alt="23333">
            </div>
        </div>
    </div>
@endsection()