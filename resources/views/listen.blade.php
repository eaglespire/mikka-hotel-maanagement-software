<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
{{--    @vite('resources/js/echo.js')--}}
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('2eed54acef880f06741b', {
            cluster: 'sa1'
        });

        var channel = pusher.subscribe('success-alert');
        channel.bind('success-alert-notification', function(data) {
            alert(JSON.stringify(data));
            //alert('Hello World')
            console.log(JSON.stringify(data))
        });
    </script>
</head>
<body>

</body>
</html>
