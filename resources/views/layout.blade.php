<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">

</head>
<body class="background-body">
    
    @yield('content')

</body>
</html>