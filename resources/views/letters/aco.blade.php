@extends('layouts.master')

@section('title', 'Medposlog')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <!-- Start breadcrumb -->
    <div class="w-full">
        <div class="flex items-center justify-between">
            <ul class="flex text-sm text-gray-600 font-normal space-x-1">
                <li>
                    <a href="#" class="hover:text-azure-radiance-500"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li>
                    <span>/&nbsp;Letters&nbsp;/</span>
                </li>
                <li>
                    <span class="font-medium text-azure-radiance-500">ACO</span>
                </li>
            </ul>
        </div>
    </div>
    <!-- End breadcrumb -->
    <div class="bg-white w-[793.70px] h-[1118.74px] shadow-sm m-auto p-[37.79px]">
        <form action="{{ route('letters.aco-print') }}" method="post">
            @csrf
            <div class="w-full flex items-center space-x-3">
                <p class="text-sm font-medium">Date:</p>
                <p class="text-sm font-medium">
                    @php
                        echo Carbon::now('Asia/Colombo')->format('Y-m-d');
                    @endphp
                </p>
            </div>
            <div class="w-full mt-3" style="line-height: 2;">
                <p class="text-sm font-bold">Airport custom officer,</p>
                <p class="text-sm font-bold">To whom it may concern,</p>
            </div>
            <div class="mt-[50px] w-full flex items-center space-x-3">
                {{-- <p class="text-sm font-bold">Mr/Mrs/Miss/Rev.</p> --}}
                <select name="aco_title" id="aco_title" class="border border-gray-400 rounded-md p-1">
                    <option value="" selected disabled>~~Select Title~~</option>
                    <option value="Mr." @php if(session('aco_title') == "Mr."){echo 'selected';}else{echo ''; } @endphp>Mr.</option>
                    <option value="Mrs." @php if(session('aco_title') == "Mrs."){echo 'selected';}else{echo ''; } @endphp>Mrs.</option>
                    <option value="Miss." @php if(session('aco_title') == "Miss."){echo 'selected';}else{echo '';} @endphp>Miss.</option>
                    <option value="Rev." @php if(session('aco_title') == "Rev."){echo 'selected';}else{echo '';} @endphp>Rev.</option>
                </select>
                <input type="text" name="aco_name" id="aco_name" class="border border-gray-400 rounded-md p-1 w-[85%]" value="@php if(session('aco_name')){echo session('aco_name');}else{echo '';} @endphp">
            </div>
            <div class="mt-2 w-full flex items-center space-x-2">
                <p class="flex text-sm font-bold"><input type="text" name="aco_age" class="border border-gray-400 rounded-md p-1" value="@php if(session('aco_age')){echo session('aco_age');}else{echo '';} @endphp" /> &nbsp;years, </p>
                <p class="flex text-sm font-bold"><input type="text" name="aco_address" id="aco_address" class="border border-gray-400 p-1 rounded-md w-[95%]" value="@php if(session('aco_address')){echo session('aco_address');}else{echo '';} @endphp" />,</p>
                <p class="text-sm font-bold">Sri Lanka</p>
            </div>
            <div class="w-full mt-[50px]" style="line-height: 2;">
                <p class="text-sm font-bold">Kindly authorize to take following medications.</p>
                <p class="text-sm font-bold">(Prescription attached)</p>
            </div>
            <div class="w-full mt-[50px]">
                <div class="flex items-center space-x-3 mb-5">
                    <p class="text-sm font-bold">Passport number</p>
                    <input type="text" name="aco_passport" id="aco_passport" class="border border-gray-400 rounded-md p-1" value="@php if(session('aco_passport')){echo session('aco_passport');}else{echo '';} @endphp">
                </div>
                <div class="flex items-center space-x-3">
                    <p class="text-sm font-bold">Prescription number</p>
                    <input type="text" name="aco_prescription" id="aco_prescription" class="border border-gray-400 rounded-md p-1" value="@php if(session('aco_prescription')){echo session('aco_prescription');}else{echo '';} @endphp">
                </div>
            </div>
            <div class="w-full mt-[50px]" style="line-height: 2;">
                <p class="text-sm font-bold">Dr.Athula Kulasinghe</p>
                <p class="text-sm font-bold">MBBS, MD, MCCP</p>
                <p class="text-sm font-bold">Consultant Physician</p>
                <p class="text-sm font-bold">Teaching Hospital</p>
                <p class="text-sm font-bold">Peradeniya</p>
            </div>

            <div data-dial-init class="fixed end-6 bottom-6 group">
                <div id="speed-dial-menu-text-inside-button-square" class="flex flex-col items-center hidden mb-4 space-y-2">
                    <button type="submit" class="w-[56px] h-[56px] text-gray-500 bg-white rounded-lg border border-gray-200 dark:border-gray-600 hover:text-azure-radiance-500 shadow-sm dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                        <i class="bi bi-printer"></i>
                        <span class="block mb-px text-xs font-medium">Print</span>
                    </button>
                    <a href="{{ route('letters.aco-clear') }}" type="button" class="justify-center w-[56px] h-[56px] text-gray-500 bg-white rounded-lg border border-gray-200 dark:border-gray-600 hover:text-azure-radiance-500 shadow-sm  dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400 px-2 py-2">
                        <i class="bi bi-x-lg text-center ms-4"></i>
                        <span class="block mb-px text-xs font-medium text-center">Clear</span>
                    </a>
                </div>
                <button type="button" data-dial-toggle="speed-dial-menu-text-inside-button-square" aria-controls="speed-dial-menu-text-inside-button-square" aria-expanded="false" class="flex items-center justify-center text-white bg-azure-radiance-500 rounded-lg w-14 h-14 hover:bg-azure-radiance-400 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                    <i class="bi bi-plus-lg w-5 h-5 transition-transform group-hover:rotate-45"></i>
                    <span class="sr-only">Open actions menu</span>
                </button>
            </div>
        </form>
    </div>
@endsection
