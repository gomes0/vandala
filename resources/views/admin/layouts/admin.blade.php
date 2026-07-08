<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Painel Administrativo')</title>

    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

</head>

<body>

    @include('admin.partials.sidebar')

    <div class="main">

        @include('admin.partials.topbar')

        <main class="content">

            @yield('content')

        </main>

    </div>

</body>

</html>