<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexo Bank</title>
    {!! Html::style('css/app.css') !!}
    <script>
        var baseUrl = '{{ URL::to('/') }}';
        var _token = '{{ csrf_token() }}';
    </script>
</head>