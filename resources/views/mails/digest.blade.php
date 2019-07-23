<!doctype html>
<html>
<head>
    <title></title>
</head>
<body>
    @foreach($messages as $message)
        <strong>{{ $message->name }}</strong>
        <p>{{ $message->contact }}</p>
        <p>{{ $message->message }}</p>
        <small>{{ $message->created_at }}</small>
        <p style="margin: 1rem 0;">=======================================================================</p>
    @endforeach
</body>
</html>
