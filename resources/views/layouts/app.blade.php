<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MB STORE</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
    lucide.createIcons();
</script>
<body class="bg-[#2933B1] text-white">

@yield('content')

</body>

</html>