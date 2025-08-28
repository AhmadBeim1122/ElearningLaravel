<!DOCTYPE html>
<html>
<head>
    @php
        $sec = 2;
        if(isset($course_id)){
             $url = route($route, ['checkid' => $course_id]);
        }else{
            $url = route($route);
        }
    @endphp
    <title>Message</title>
    <meta http-equiv="refresh" content="{{ $sec }};url={{ $url }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            text-align: center;
        }
        .message-box h2 {
            color: green;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h2>{{ $msg }}</h2>
        <p>You will be redirected to the home page in {{ $sec }} seconds...</p>
    </div>
</body>
</html>
