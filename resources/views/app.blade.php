<!DOCTYPE html>
<html class='h-full'>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>

<body class='h-full'>
    <div id='app' class="h-full" data-page="{{ json_encode($page) }}"></div>
</body>

</html>
