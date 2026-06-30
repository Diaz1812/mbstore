<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MB Store Admin</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-[#2933B1] text-white">

<div id="pageTransition">

    <div class="flex min-h-screen">

        @include('components.sidebar')

        <main class="flex-1 p-10">

            @yield('content')

        </main>

    </div>

</div>

</body>

</html>