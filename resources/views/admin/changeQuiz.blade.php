@extends('admin.index')

@section('content')
    <div class="row col-md-10 col-md-offset-1">
        @include('admin.quizForm')
        <div class="row col-md-10">
            <a href="{{ route('admin.dashboard') }}"><button class="btn btn-primary">back</button></a>
        </div>
    </div>
@endsection