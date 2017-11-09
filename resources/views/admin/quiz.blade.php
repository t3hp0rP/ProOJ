<div class="tab-pane fade in active" id="quiz">
    <div class="row">
        <button type="button" class="btn btn-info pull-right" id="dropdownForm" data-toggle="collapse" href="#collapseOne">新增题目</button>
    </div>
    <div class="row">
        <div id="collapseOne" class="panel-collapse collapse">
            @include('admin.quizForm')
        </div>
    </div>
    <table class="table table-hover" style="word-break:break-all; word-wrap: break-word;">
        <colgroup>
            <col style="width:4%">
            <col style="width:6%;">
            <col style>
            <col style>
            <col style="width:13%">
            <col style="width:5%">
            <col style>
            <col style="width:4%">
            <col style>
            <col style>
        </colgroup>
        <thead>
            <tr>
                <th>id</th>
                <th>类型</th>
                <th>标题</th>
                <th>题目描述</th>
                <th>题目地址(附件)</th>
                <th>分值</th>
                <th>flag</th>
                <th>alive</th>
                <th>创建时间</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($quizs as $k => $quiz)
            <tr>
                <td>{{ ($quizs->currentPage() - 1) * 10 + $k + 1 }}</td>
                <td>{{ \App\Quiz::getPart($quiz->type)['content'] }}</td>
                <td>{{ $quiz->title }}</td>
                <td>{{ $quiz->content }}</td>
                <td>{{ $quiz->addr }}</td>
                <td>{{ $quiz->value }}</td>
                <td>{{ $quiz->flag }}</td>
                <td>{{ $quiz->active }}</td>
                <td>{{ $quiz->created_at }}</td>
                <td>
                    <a href="{{ route('admin.changeQuiz',$quiz->id) }}"><button class="btn btn-primary">Change</button></a>
                    <a href="{{ route('admin.delQuiz',$quiz->id) }}"><button class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $quizs->render() }}
</div>