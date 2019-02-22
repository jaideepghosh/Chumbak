<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chumbak @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet"> 

    <style>
        .container{
            padding-top: 70px;
        }
        body{
            font-family: 'Source Sans Pro', 'Open Sans', sans-serif;
        }
        .btn-link{
          padding-top: 0;
        }
    </style>
    @yield('header')
</head>
<body>


<nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
  <a class="navbar-brand" href="<?php echo url('/');?>">
        <img src="<?php echo url('/');?>/img/logo.png" alt="" class="img-fluid" width="100">
  </a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo url('/').'/categories';?>">Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo url('/').'/products';?>">Products</a>
    </li>
  </ul>
</nav>

<div class="container">
    @yield('content')
</div>

@yield('footer')
</body>
</html>