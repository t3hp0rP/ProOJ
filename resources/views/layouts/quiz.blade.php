@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $part }}</div>
                <div class="panel-body">
                    <a class="btn" href="{{ route('home') }}"><span class="glyphicon glyphicon-arrow-left"></span> back</a>
                    <hr>
                    <div class="col-md-12 text-center">
                        {{--start to write--}}
                        <div class="row">
                            @foreach($quizDatas as $k => $quizData)
                                <div class="col-md-3">
                                    <button class="btn btn-default add-bottom-margin btn-block {{ isset($info[$quizData->id]) ? 'btn-primary' : '' }}" data-toggle="modal" data-target="#{{ $quizData->getPart($quizData->type)['content'].$quizData->id }}" name="quizButton">
                                        <div class="panel-body">
                                            {{ $quizData->title }}
                                        </div>
                                    </button>
                                    <div class="modal fade" id="{{ $quizData->getPart($quizData->type)['content'].$quizData->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $quizData->type }}" aria-hidden="true">
                                        <div class="alert" style="display: none;" id="message">message</div>
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                        &times;
                                                    </button>
                                                    <h4 class="modal-title">
                                                        {{ $quizData->title }}
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <span class="bg-danger text-danger score">Score : {{ $quizData->value }}</span>
                                                    <br>
                                                    <br>
                                                    {{ $quizData->content }}
                                                    <br>
                                                    address : <a href="{{ $quizData->addr }}">{{ $quizData->addr }}</a>
                                                    <br>
                                                    <br>
                                                    <form action="#" class="form-horizontal" role="form">
                                                        <input type="hidden" name="quizName" value="{{ $quizData->id }}">
                                                        <div class="form-group">
                                                            {{ csrf_field() }}
                                                            <label for="flag" class="control-label col-md-3 text-right">flag : </label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="flag" id="flag" class="form-control">
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <br>
                                                    <div class="row">
                                                        {{ isset($bloods[$k][0]['name']) ? 'First Blood: '.$bloods[$k][0]['name'] : '' }}
                                                        <br>
                                                        {{ isset($bloods[$k][1]['name']) ? 'Second Blood: '.$bloods[$k][1]['name'] : '' }}
                                                        <br>
                                                        {{ isset($bloods[$k][2]['name']) ? 'Third Blood: '.$bloods[$k][2]['name'] : '' }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary" onclick="submitFlag($(this))">
                                                        Submit Flag
                                                    </button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal -->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection