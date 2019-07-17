<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loading...</title>
    <link rel="stylesheet" href="{{ mix('/css/avaire.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    <div id="avaire">
        <app></app>
    </div>

    <script>
        window.baseUrl = "{{ trim(config('app.url'), '/') }}";
        window.baseApiUrl = "{{ trim(config('ava.api-url'), '/') }}";
    </script>
    <script src="{{ mix('/js/avaire.js') }}"></script>
    <script type="text/javascript" id="cookieinfo"
        src="//cookieinfoscript.com/js/cookieinfo.min.js"
        data-fg="#EBEBEB"
        data-bg="#141414"
        data-link="#FB4622"
        data-divlink="#EBEBEB"
        data-divlinkbg="#FB4622"
        data-close-text="Got it!"
    ></script>
</body>
</html>
