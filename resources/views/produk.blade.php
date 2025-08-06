<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@auth

    @if (Auth::user()->role === 'admin')
    <!-- Admin -->
        @include('sidebar.admin')
        @include('admin.produk')

         @else
        <!-- User -->
        @include('sidebar.user')
        @include('user.produk') 
    @endif
@endauth