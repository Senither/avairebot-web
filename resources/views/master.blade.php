<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loading...</title>
    <link rel="stylesheet" href="{{ url('/') . mix('/css/avaire.css') }}">
</head>
<body>
    <div id="avaire">
        <app></app>
    </div>

    <script>
        window.baseUrl = "{{ trim(config('app.url'), '/') }}";
    </script>
    <script src="{{ url('/') . mix('/js/avaire.js') }}"></script>
</body>
</html>
