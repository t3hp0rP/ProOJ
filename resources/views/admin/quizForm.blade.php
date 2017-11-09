<div class="well">
    <form class="form-horizontal" role="form" action="#" method="post" id="quizForm">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="quizId" value="{{ isset($content) ? $content['id'] : ''}}">
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="optionsRadios" class="col-sm-2 control-label">类型</label>
            <div class="col-sm-10">
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="type" id="optionsRadios1" value="web" <?php if (old('type') == 'web' or (isset($content) and $content['type'] == '0')) echo 'checked'; elseif (old('type') == '') echo 'checked' ?>> Web
                    </label>
                </div>
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="type" id="optionsRadios2" value="pwn" <?php if (old('type') == 'pwn' or (isset($content) and $content['type'] == '1')) echo 'checked' ?>> Pwn
                    </label>
                </div>
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="type" id="optionsRadios2" value="misc" <?php if (old('type') == 'misc' or (isset($content) and $content['type'] == '3')) echo 'checked' ?>> Misc
                    </label>
                </div>
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="type" id="optionsRadios2" value="reverse" <?php if (old('type') == 'reverse' or (isset($content) and $content['type'] == '2')) echo 'checked' ?>> Reverse
                    </label>
                </div>
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="type" id="optionsRadios2" value="crypto" <?php if (old('type') == 'crypto' or (isset($content) and $content['type'] == '4')) echo 'checked' ?>> Crypto
                    </label>
                </div>
                @if ($errors->has('type'))
                    <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-sm-2 control-label">标题</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title" placeholder="题目标题" value="<?php if (old('title') != '') echo old('title'); elseif (isset($content) and $content['title'] != '') echo $content['title']; ?>">
                @if ($errors->has('title'))
                    <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="content" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" name="description" class="form-control" id="content" placeholder="题目描述" value="<?php if (old('content') != '') echo old('content'); elseif (isset($content) and $content['content'] != '') echo $content['content']; ?>">
                @if ($errors->has('description'))
                    <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('addr') ? ' has-error' : '' }}">
            <label for="addr" class="col-sm-2 control-label">题目链接(附件)</label>
            <div class="col-sm-10">
                <input type="text" name="addr" class="form-control" id="addr" placeholder="题目链接(附件)" value="<?php if (old('addr') != '') echo old('addr'); elseif (isset($content) and $content['addr'] != '') echo $content['addr']; ?>" <?php if (old('addr') != '' or (isset($content) and substr($content['addr'],0,strlen(env('APP_URL'))+6) == env('APP_URL').'static' )) echo 'readonly="readonly"' ?>>
                @if ($errors->has('addr'))
                    <span class="help-block">
                            <strong>{{ $errors->first('addr') }}</strong>
                        </span>
                @endif
                <br>
                <span id="uploadArea">
                @if(old('addr') != '' or (isset($content) and substr($content['addr'],0,strlen(env('APP_URL'))+6) == env('APP_URL').'static' ))
                    <button class="btn btn-info <?php if (old('addr') == '' and (isset($content) and substr($content['addr'],0,strlen(env('APP_URL'))+6) != env('APP_URL').'static' )) echo 'hidden'; ?>" id="removeBtn" type="button">remove</button>
                @elseif (old('addr') == '')
                    <input type="file" name="file" id="quizFile" onchange="uploadFile()">
                @endif
                </span>
            </div>
        </div>
        <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
            <label for="value" class="col-sm-2 control-label">题目分值</label>
            <div class="col-sm-10">
                <input type="text" name="value" class="form-control" id="value" placeholder="题目分值" value="<?php if (old('value') != '') echo old('value'); elseif (isset($content) and $content['value'] != '') echo $content['value']; ?>">
                @if ($errors->has('value'))
                    <span class="help-block">
                            <strong>{{ $errors->first('value') }}</strong>
                        </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('flag') ? ' has-error' : '' }}">
            <label for="flag" class="col-sm-2 control-label">flag</label>
            <div class="col-sm-10">
                <input type="text" name="flag" class="form-control" id="flag" placeholder="flag" value="<?php if (old('flag') != '') echo old('flag'); elseif (isset($content) and $content['flag'] != '') echo $content['flag']; ?>">
                @if ($errors->has('flag'))
                    <span class="help-block">
                            <strong>{{ $errors->first('flag') }}</strong>
                        </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
            <div class="col-sm-offset-2 col-sm-10">
                <label for="active" class="col-sm-2 control-label">是否公布
                    <input id="active" name="active" value="1" type="checkbox" <?php if (old('active') == 1 or (isset($content) and $content['active'] == 1)) echo 'checked' ?>>
                </label>
            </div>
            @if ($errors->has('active'))
                <span class="help-block">
                        <strong>{{ $errors->first('active') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
</div>