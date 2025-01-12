<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else

        @endif
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <h1>
        commify test
    </h1>

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        @endif

        <form  method="post" action="{{ route('store.salary') }}">
            @csrf
            <input type="text" name="salary" placeholder="entrer your salary"/>
            <button>calculate</button>

        </form>

    @isset($salaryDetails)
            <p> Gross annual salary: {{ '£' ." ". $salaryDetails['grossAnnualSalary']  }}</p>
            <p> Gross monthly salary: {{ '£' ." ". $salaryDetails['grossMonthlySalary']  }}</p>
            <p>net annual salary : {{ '£' ." ". $salaryDetails['netAnnualSalary']  }}</p>
            <p>net monthly salary :  {{ '£' ." ". $salaryDetails['netMonthlySalary']  }}</p>
            <p>annual tax paid :  {{ '£' ." ". $salaryDetails['annualTaxPaid']  }}</p>
            <p>monthly tax paid :  {{ '£' ." ". $salaryDetails['monthlyTaxPaid']  }}</p>

    @endisset
    </body>
</html>
