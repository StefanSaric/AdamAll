<!DOCTYPE html>
<html lang="en">
<head>
    <title>Boostbox - Dashboard</title>
    @include('layouts.head')
</head>
<body class="body-striped">
    @include('layouts.header')

    <!-- BEGIN BASE-->
    <div id="base">
        @include('layouts.sidebar')
        <div id = 'content'>
        @yield('content')
        </div>
    </div>
    @include('layouts.scripts')
</body>
</html>
