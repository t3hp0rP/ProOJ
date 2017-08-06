@extends('layouts.app')

@section('content')
<div class="container">
    @include('message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome! {{ Auth::user()->name }}
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <a class="menu part text-center" href="{{ url('part/web') }}">
                                    <div class="panel panel-default">
                                        <div class="panel-body">Web</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="menu part text-center" href="{{ url('part/pwn') }}">
                                    <div class="panel panel-default">
                                        <div class="panel-body">Pwn</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="menu part text-center"  href="{{ url('part/misc') }}">
                                    <div class="panel panel-default">
                                        <div class="panel-body">Misc</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="menu part text-center" href="{{ url('part/reverse') }}">
                                    <div class="panel panel-default">
                                        <div class="panel-body">Reverse</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="menu part text-center" href="{{ url('part/crypto') }}">
                                    <div class="panel panel-default">
                                        <div class="panel-body">Crypto</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
