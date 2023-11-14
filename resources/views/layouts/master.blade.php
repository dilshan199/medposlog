<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Flowbite theme CSS cdn -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css"  rel="stylesheet" />
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Default css -->
    <link rel="stylesheet" href="{{ asset('css/dist/output.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" type="text/css">
    <!-- Jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>

    <title>@yield('title')</title>
</head>
<body class="bg-gray-100">
    <!-- Start top nav -->
    <nav class="bg-white flex item-center justify-between shadow-md fixed top-0 left-0 w-full px-3 py-3">
        <div class="flex item-center justify-start">
            <h2 class="text-2xl font-bold italic"><span class="text-azure-radiance-500">Med</span>poslog</h2>
            <ul class="ms-10 text-gray-700 flex item-center space-x-5">
                <li>
                    <a href="#" class="flex item-center text-center space-x-2 hover:text-azure-radiance-500 hover:bg-gray-100 rounded-md px-2 py-2">
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a type="button" id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="flex item-center text-center space-x-2 cursor-pointer hover:text-azure-radiance-500 hover:bg-gray-100 rounded-md px-2 py-2">
                        <i class="bi bi-building-gear"></i>
                        <span class="flex-1">Manage</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{ route('problem.index') }}" class="block px-4 py-2 hover:bg-gray-100  hover:text-azure-radiance-500 ">Problem</a>
                            </li>
                            <li>
                                <a href="{{ route('investigation.index') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-azure-radiance-500 ">Investigation</a>
                            </li>
                            <li>
                                <a href="{{ route('clinic.index') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-azure-radiance-500">Clinic</a>
                            </li>
                            <li>
                                <a href="{{ route('drugs.index') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-azure-radiance-500 ">Drugs</a>
                            </li>
                            <li>
                                <a href="{{ route('frequency.index') }}" class="block px-4 py-2 hover:bg-gray-100 hover:text-azure-radiance-500 ">Frequency</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a type="button" id="letterDropBtn" data-dropdown-toggle="letterDrop" class="flex item-center text-center space-x-2 cursor-pointer hover:text-azure-radiance-500 hover:bg-gray-100 rounded-md px-2 py-2">
                        <i class="bi bi-file-earmark-text"></i>
                        <span class="flex-1">Letters</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <!-- Dropdown menu -->
                    <div id="letterDrop" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:text-azure-radiance-500 ">ACO</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:text-azure-radiance-500 ">Clinic</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:text-azure-radiance-500 ">Fee</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:text-azure-radiance-500 ">Letter 4</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('oauth.index') }}" id="userDropBtn" data-dropdown-toggle="userDrop" class="flex item-center text-center space-x-2 cursor-pointer hover:text-azure-radiance-500 hover:bg-gray-100 rounded-md px-2 py-2">
                        <i class="bi bi-person-fill-add"></i>
                        <span class="flex-1">Users</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="flex items-center text-gray-900 dark:text-gray-400 space-x-4">
                <li class="relative">
                    <a type="button" id="profileDropBtn" data-dropdown-toggle="profileDropContent" data-dropdown-placement="bottom" data-dropdown-offset-distance="25" data-dropdown-offset-skidding="-10" class="flex items-center hover:text-navy-blue-300 cursor-pointer" title="Profile">
                        <span class="w-10 h-10 rounded-full text-lg font-bold bg-gray-100 dark:bg-gray-700 text-azure-radiance-500 dark:text-azure-radiance-500 flex items-center justify-center relative">
                            @php
                                echo Str::upper(Str::substr($user_data->user_name, 0, 1))
                            @endphp
                            <span class="w-3 h-3 rounded-full bg-green-600 border-2 border-white dark:border-gray-800 top-6 -right-1 absolute"></span>
                        </span>
                        <div class="ml-2 hidden md:block">
                            <h6 class="font-medium text-sm">{{ $user_data->user_name }}</h6>
                            <p class="text-xs font-light">{{ $user_data->user_type }}</p>
                        </div>
                    </a>
                    <div id="profileDropContent" aria-labelledby="profileDropBtn" class="absolute w-48 h-auto bg-white dark:bg-gray-800 shadow-md top-14 right-2 rounded-md hidden">
                        <div class="flex items-center border-b border-b-gray-100 dark:border-b-gray-700 py-4 px-2">
                            <span class="w-10 h-10 rounded-full text-lg font-bold bg-gray-100 dark:bg-gray-700 text-azure-radiance-500 dark:text-azure-radiance-500 flex items-center justify-center relative">
                                @php
                                    echo Str::upper(Str::substr($user_data->user_name, 0, 1))
                                @endphp
                                <span class="w-3 h-3 rounded-full bg-green-600 border-2 border-white dark:border-gray-800 top-6 -right-1 absolute"></span>
                            </span>
                            <div class="ml-2">
                                <h6 class="font-medium text-sm text-gray-900 dark:text-gray-400">{{ $user_data->user_name }}</h6>
                                <p class="text-xs font-light text-gray-900 dark:text-gray-400">{{ $user_data->user_type }}</p>
                            </div>
                        </div>
                        <div class="px-2 py-4">
                            <ul class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                                <li>
                                    <a href="{{ route('oauth.sign-out')}}" class="hover:text-azure-radiance-500 dark:hover:text-azure-radiance-200 flex items-center space-x-2">
                                        <i class="bi bi-power"></i>
                                        <span>Sign out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End top nav -->

    <!-- Start Panel -->
    <div class="px-3 py-4 w-full mt-14">
        @yield('content')
    </div>
    <!-- End Panel -->
    <!-- Flowbite theme js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</body>
</html>
