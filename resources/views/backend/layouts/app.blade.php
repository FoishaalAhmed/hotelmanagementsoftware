<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('backend.layouts.head')
</head>
<body class="hold-transition skin-blue sidebar-mini" <?php if (session()->has('message')) echo "onload='setTimeout(snackbar_function, 100)';" ?>>
    <div id="snackbar">{{session('message')}}</div>
    <div class="wrapper">
        @include('backend.layouts.header')
        @include('backend.layouts.sidebar')

        @section('content')
            
        @show

        @include('backend.layouts.footer')
    </div>
</body>
</html>