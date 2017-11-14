@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="lead col-md-12">User Center</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ url('change') }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-4">
                                            <span id="email" class="form-control" name="email" disabled>{{ $info['email'] }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="schoolId" class="col-md-4 control-label">学号</label>

                                        <div class="col-md-4">
                                            <span id="schoolId" class="form-control" name="schoolId" disabled>{{ $info['schoolId'] }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>

                                        <div class="col-md-4">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter password to verify" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name</label>

                                        <div class="col-md-4">
                                            <input id="name" type="text" class="form-control" name="name" placeholder="New name" value="{{ $info['name'] }}">

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                        <label for="new_password" class="col-md-4 control-label">New Password</label>

                                        <div class="col-md-4">
                                            <input id="new_password" type="password" class="form-control" name="new_password" placeholder="New password">

                                            @if ($errors->has('new_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                                        <label for="new_password_confirmation" class="col-md-4 control-label">New Password Confirm</label>

                                        <div class="col-md-4">
                                            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" placeholder="New password_confirm">

                                            @if ($errors->has('new_password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-4 control-label">Phone</label>

                                        <div class="col-md-4">
                                            <input id="phone" type="text" class="form-control" name="phone" placeholder="New Phone" value="{{ $info['phone'] }}">

                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-md-offset-5">
                                        <button class="btn btn-info" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection