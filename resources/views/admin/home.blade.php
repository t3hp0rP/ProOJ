@extends('admin.index')

@section('content')
    <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a href="#quiz" data-toggle="tab">
                            题目
                        </a>
                    </li>
                    <li><a href="#user" data-toggle="tab">用户</a></li>
                    <li class="dropdown">
                        <a href="#" id="myTabDrop1" class="dropdown-toggle"
                           data-toggle="dropdown">Docker
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                            <li><a href="#wtf1" tabindex="-1" data-toggle="tab">action1</a></li>
                            <li><a href="#wtf2" tabindex="-1" data-toggle="tab">action2</a></li>
                        </ul>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="alert alert-danger {{ $error != '' ? '' : 'hidden' }}">{{ $error != '' ? $error : '' }}</div>
                    <div class="alert alert-success {{ $success != '' ? '' : 'hidden' }}">{{ $success != '' ? $success : '' }}</div>
                    @include('admin.quiz')
                    <div class="tab-pane fade" id="user">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-8 text-center">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="Detail">
                                            <h2>Detail</h2>
                                            <p>We have <span class="text-success">{{ $registerNum }}</span> register record</p>
                                            <p>We have <span class="text-success">{{ $activeNum }}</span> activation record</p>
                                        </div>
                                        <div class="tab-pane fade" id="ManageUser">
                                            <h2>User Manage</h2>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>name</th>
                                                        <th>schoolID</th>
                                                        <th>email</th>
                                                        <th>phone</th>
                                                        <th>isActive</th>
                                                        <th>registerTime</th>
                                                        <th>action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($users as $k => $user)
                                                    <tr>
                                                        <td>{{ ($users->currentPage() - 1) * 10 + $k + 1 }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->schoolId }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->isActive }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary dropdown-toggle" id="actionMenu" data-toggle="dropdown">Action
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="actionMenu">
                                                                <li role="presentation">
                                                                    <a role="menuitem" tabindex="-1" href="#">Change</a>
                                                                </li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" tabindex="-1" href="#">Delete</a>
                                                                </li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" tabindex="-1" href="#">Activate</a>
                                                                </li>
                                                                <li role="presentation" class="divider"></li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" tabindex="-1" href="#">???</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{ $users->render() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="well">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active"><a href="#Detail" data-toggle="tab">Detail</a></li>
                                            <li><a href="#ManageUser" data-toggle="tab">Manage User</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="wtf1">
                        <p>under construction</p>
                    </div>
                    <div class="tab-pane fade" id="wtf2">
                        <p>under construction</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()