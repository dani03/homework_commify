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

    @if(session()->has('success'))
        @if(session('success'))
            <div class="max-w-md mx-auto p-4 mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg shadow-md">
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <h2 class="ml-2 text-lg font-bold">Success!</h2>
                </div>
                <p class="ml-8">{{ session('success') }}</p>
            </div>
        @endif
    @endif


    <!-- Form -->
    <form method="post" action="{{ route('store.salary') }}" class="bg-white shadow-md rounded-lg p-6 w-1/2">
        @csrf
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Enter your gross salary</h2>

        <!-- Text Input -->
        <x-input-component />
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
            <x-details-salary-component :details="$salaryDetails"/>
        @endisset

    </form>
    <div class="mt-4 btn border-none rounded p-2 bg-cyan-500">
        <a href="{{route('show.tax')}}" class="p-2 text-white"> want to add a new tax band ? </a>

    </div>
</div>
</body>
</html>
