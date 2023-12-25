@extends('layouts.master')

@section('title', 'MedOne')

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
                    <span class="font-medium text-azure-radiance-500">Radiology Referral</span>
                </li>
            </ul>
        </div>
    </div>
    <!-- End breadcrumb -->
    <div class="bg-white w-[793.70px] h-[1118.74px] shadow-sm m-auto p-[37.79px]">
        <form action="{{ route('letters.radiology-print') }}" method="post">
            @csrf
            <div class="w-full mt-3" style="line-height: 2;">
                <p class="text-sm font-bold">Family Care Medical Consultation Center</p>
                <p class="text-sm font-bold">No. 47,</p>
                <p class="text-sm font-bold">Hulangamuwa Road,</p>
                <p class="text-sm font-bold">Matale</p>
                <p class="text-sm font-bold">071 4352116 /066 2230681</p>
            </div>
            <div class="w-full flex items-center justify-start space-x-3 mt-5">
                <p class="text-sm font-medium">Date:</p>
                <p class="text-sm font-medium">
                    @php
                        echo Carbon::now('Asia/Colombo')->format('Y-m-d');
                    @endphp
                </p>
            </div>
            <div class="mt-[25px] w-full" style="line-height: 4">
                <p class="text-sm font-bold mb-1"><input type="text" name="r_letter_whom" id="r_letter_whom" class="p-1 rounded-md border border-gray-400" value="@php if(session('r_letter_whom')){echo session('r_letter_whom');}else{echo '';} @endphp"></p>
                <p class="text-sm font-bold">Consultant Radiologist</p>
                <p class="text-sm font-bold">Dear colleague,</p>
            </div>
            <div class="flex items-center space-x-3 mt-3">
                <select name="r_letter_title" id="r_letter_title" class="border border-gray-400 rounded-md p-1">
                    <option value="" selected disabled>~~Select Title~~</option>
                    <option value="Mr." @php if(session('r_letter_title') == "Mr."){echo 'selected';}else{echo ''; } @endphp>Mr.</option>
                    <option value="Mrs." @php if(session('r_letter_title') == "Mrs."){echo 'selected';}else{echo ''; } @endphp>Mrs.</option>
                    <option value="Miss." @php if(session('r_letter_title') == "Miss."){echo 'selected';}else{echo '';} @endphp>Miss.</option>
                    <option value="Rev." @php if(session('r_letter_title') == "Rev."){echo 'selected';}else{echo '';} @endphp>Rev.</option>
                </select>
                <input type="text" name="r_letter_name" id="r_letter_name" class="border border-gray-400 rounded-md p-1 w-[85%]" value="@php if(session('r_letter_name')){echo session('r_letter_name');}else{echo '';} @endphp">
            </div>
            <div class="mt-2 w-full flex items-center space-x-2">
                <p class="flex text-sm font-bold"><input type="text" name="r_letter_age" class="border border-gray-400 rounded-md p-1" value="@php if(session('r_letter_age')){echo session('r_letter_age');}else{echo '';} @endphp" /> &nbsp;years, </p>
                <p class="flex text-sm font-bold"><input type="text" name="r_letter_address" id="r_letter_address" class="border border-gray-400 p-1 rounded-md w-[95%]" value="@php if(session('r_letter_address')){echo session('r_letter_address');}else{echo '';} @endphp" /></p>
            </div>
            <div class="w-full mt-3" style="line-height: 1.5">
                <div class="flex  mb-2 space-x-2">
                    <p class="text-sm font-bold">Please kindly arrange</p>
                    <div class="mb-3">
                        <div class="flex items-center">
                            <input type="text" id="illness" name="illness" class="border-gray-400 p-[5px] text-sm w-full rounded-md" autocomplete="off" value="@php if(session('illness')){echo session('illness');}else{echo '';} @endphp">
                            {{-- <button type="button" id="searchType" name="search_type" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                <i class="bi bi-search"></i>
                            </button> --}}
                        </div>
                        <div class="w-full h-[150px] overflow-y-scroll overflow-x-hidden">
                            <table id="illnessTable" class="w-full">
                                @foreach ($illness as $ill)
                                    <tr>
                                        <td class="border border-gray-400 p-1 text-sm text-gray-600 cursor-pointer hover:bg-gray-100">{{ $ill->illness }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <textarea name="r_letter_problem" id="r_letter_problem" cols="30" rows="5" class="w-full rounded-md border border-gray-400 p-1">@php if(session('r_letter_problem')){echo session('r_letter_problem');}else{echo '';} @endphp</textarea>
                <p class="text-sm font-bold">for this patient.</p>
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
                    <a href="{{ route('letters.radiology-clear') }}" type="button" class="justify-center w-[56px] h-[56px] text-gray-500 bg-white rounded-lg border border-gray-200 dark:border-gray-600 hover:text-azure-radiance-500 shadow-sm  dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400 px-2 py-2">
                        <i class="bi bi-x-lg"></i>
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

    <script src="{{ asset('js/get-illness.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-illness-table.js') }}" type="text/javascript"></script>
@endsection
