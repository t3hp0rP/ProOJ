@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="raw">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-striped table-bordered">
                    <caption>GDUFS Hack Team OJ Rank</caption>
                    <thead>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Point</th>
                        <th>Major in</th>
                    </thead>
                    <tbody>
                    @foreach($ranks as $k => $rank)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $rank->name }}</td>
                            <td>{{ $rank->point }}</td>
                            <td>{{ $rank->major or '暂无数据' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $ranks->links() }}
            </div>
        </div>
    </div>
@endsection