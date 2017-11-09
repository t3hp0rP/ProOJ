{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<title>Pro OJ激活邮件</title>--}}
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}
{{--<body>--}}
    尊敬的{{ $name }} :
    <br>
    <br>
    <br>
    <a href="{{ URL( 'activation' ,array('uid' => $uid, 'activeCode' => $activeCode)) }}" target="_blank">
            请点击此处激活Pro OJ平台
    </a>
{{--</body>--}}
{{--</html>--}}