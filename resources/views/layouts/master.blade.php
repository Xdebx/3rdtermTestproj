<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/.../css/bootstrap.min.css" >
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css"/>

        <link rel="stylesheet" href="{{ url('src/css/app.css')}}">

        @yield('styles')
    </head>
    <body>
        {{-- <style>
        body {
            /*background: #76b852;  fallback for old browsers */
            /*background: rgb(141,194,111);*/
            background: radial-gradient(#070707,#ebebeb) repeat;
            /*background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);*/
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
          
            /*background: linear-gradient(90deg, rgba(141,194,111,1) 0%, rgba(118,184,82,1) 50%);*/
            /*background: linear-gradient(#141e30, #243b55);*/
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;      
          }
          </style> --}}
    @include('partials.header')
    {{-- @include('partials.base') --}}
    <div class="container">
        @yield('content')
    </div>


    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/.../js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/.../Chart.js/2.9.3/Chart.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    @yield('scripts')
    </body>
</html>
