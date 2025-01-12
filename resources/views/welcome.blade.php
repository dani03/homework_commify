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


<header>
    <h1 class="mt-4 first-letter:capital text-5xl text-center font-bold ">
        commify test
    </h1>
</header>


<div class="flex flex-col items-center justify-center min-h-96">

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
        <input required type="text" name="salary" id="salary" placeholder="entrer your salary"
               class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">

        <!-- Button -->
        <div class="flex space-x-4">
            <button
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Calculate
            </button>
        </div>

        <!-- Salary Details -->
        <div class="mt-6 text-gray-600 text-lg">
            @isset($salaryDetails)
                <p>Gross annual salary: {{ '£' . " " . $salaryDetails['grossAnnualSalary'] }}</p>
                <p>Gross monthly salary: {{ '£' . " " . $salaryDetails['grossMonthlySalary'] }}</p>
                <p>Net annual salary: {{ '£' . " " . $salaryDetails['netAnnualSalary'] }}</p>
                <p>Net monthly salary: {{ '£' . " " . $salaryDetails['netMonthlySalary'] }}</p>
                <p>Annual tax paid: {{ '£' . " " . $salaryDetails['annualTaxPaid'] }}</p>
                <p>Monthly tax paid: {{ '£' . " " . $salaryDetails['monthlyTaxPaid'] }}</p>
            @endisset
        </div>
    </form>
</div>



</body>
</html>
