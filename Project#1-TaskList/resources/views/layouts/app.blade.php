<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TaskList</title>
</head>
<body>
    <section class="container mx-auto h-screen flex justify-center items-center">
        <div class="rounded-2xl h-3/4 w-3/4 flex flex-wrap flex-col shadow-2xl">
            <header class="bg-indigo-600 rounded-t-2xl w-full h-1/4 flex justify-center items-center"> @yield('title') </header>
            <main class="h-3/4 w-full flex justify-center items-center flex-col"> @yield('form')  </main>
        </div>
    </section>
</body>
</html>



  