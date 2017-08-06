@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(isset($message))
                <div class="row">
                    <div class="alert alert-info">
                        {{ $message }}
                    </div>
                </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="lead col-md-12">User Center</div>
                        </div>
                        <a class="btn" href="{{ route('home') }}"><span class="glyphicon glyphicon-arrow-left"></span> back</a>

                        <div class="row">
                            <div class="row">
                                <label for="email" class="col-md-2 control-label col-md-offset-3 text-right">E-Mail</label>

                                <div class="col-md-1">
                                    <span id="email" name="email">{{ Auth::user()->email }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <label for="name" class="col-md-2 control-label col-md-offset-3 text-right">Name</label>

                                <div class="col-md-1">
                                    <span id="name" name="name">{{ Auth::user()->name }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <label for="point" class="col-md-2 control-label col-md-offset-3 text-right">Point</label>

                                <div class="col-md-1">
                                    <span id="point" name="point">{{ $info['point'] }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-md-offset-9 text-center">
                                    <a href="{{ url('change') }}"><button class="btn btn-info">Change</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection