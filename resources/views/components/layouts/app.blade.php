<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ryck and morthy api</title>
     @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-900">
<nav class="bg-gray-800 p-4">
  <div class="max-w-7xl mx-auto flex justify-between items-center">
    <a href="#" class="text-white text-xl font-semibold">ryck  and  morty api</a>
    <div class="space-x-4">
      <a href="{{ Route('home') }}" class="text-white hover:text-gray-300">datos cargados a mysql</a>
      <a href="{{ Route('api-personajes') }}" class="text-white hover:text-gray-300">datos de la api </a>
    </div>
  </div>
</nav>

<div>
                {{ $slot }}
            </div>
   
   @livewireScripts
      
    @stack('scripts')
</body>