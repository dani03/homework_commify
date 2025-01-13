<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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
    <form method="post" action="{{ route('store.salary') }}" class="bg-white shadow-md rounded-lg p-6 w-1/2">
        @csrf
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Enter your gross salary</h2>

        <!-- Text Input -->
        <x-input-component/>
        <!-- Button -->
        <div class="flex space-x-4">
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Calculate
            </button>
        </div>

        <!-- Salary Details -->
            @if(session()->has('salaryDetails'))
                @php
                    $salaryDetails = session('salaryDetails');
                @endphp
           @endif

            @isset($salaryDetails)
                    <x-details-salary-component :details="$salaryDetails" />
            @endisset

    </form>
</div>
</body>
</html>
