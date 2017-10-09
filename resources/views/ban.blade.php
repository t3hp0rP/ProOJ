@extends('layouts.app')

@section('content')
    <div class="container">
        @include('message')
        <div class="row">
            <div class="col-md-6 col-md-offset-4">
                <span style="font-size: 20px">
                    比赛还没开始咧
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ asset('img/e4f1ec0d4e4c5c9eed3658b25cc1c7b3.jpg') }}" alt="23333">
            </div>
        </div>
    </div>
@endsection