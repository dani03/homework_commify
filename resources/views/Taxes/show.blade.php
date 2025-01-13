<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tax Calculator </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>
<body class="font-sans antialiased dark:bg-black">


<div class="flex flex-col items-center justify-center min-h-96">
    <x-logo></x-logo>
    <!-- Error Message -->
    <div class="text-red-500 text-3xl font-bold mb-4">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </div>

    <!-- Form -->
    <form method="post" action="{{ route('store.tax') }}" class="bg-white shadow-md rounded-lg p-6 w-1/2">
        @csrf
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Enter a new tax range</h2>

        <!-- Text Input -->
        <x-input-classic label="name of tax" name="name" type="text" placeholder="e.g: range casual" isRequired="true" />
        <x-input-classic label="annual tax band" type="number" name="annual_band" placeholder="10000" isRequired="true" />
        <x-input-classic label="range" type="text" name="range" placeholder="eg: is 20 000 - 40 000" isRequired="false" />
        <x-input-classic label="percent" type="number" name="percent" placeholder="40" isRequired="true" />
        <!-- Button -->
        <div class="flex space-x-4">
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Validate
            </button>
        </div>


    </form>

</div>
</body>
</html>
