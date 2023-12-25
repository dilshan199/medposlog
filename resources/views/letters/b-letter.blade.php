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
                    <span class="font-medium text-azure-radiance-500">Blood Picture Referral</span>
                </li>
            </ul>
        </div>
    </div>
    <!-- End breadcrumb -->
    <div class="bg-white w-[793.70px] h-[1118.74px] shadow-sm m-auto p-[37.79px]">
        <form action="{{ route('letters.blodd-picture-print') }}" method="post">
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
                <div class="flex space-x-1 items-center">
                    <p class="text-sm font-bold">Dr.</p>
                    <p><input type="text" name="b_cubical" id="b_cubical" class="border border-gray-400 rounded-md p-1" value="@php if(session('b_cubical')){echo session('b_cubical');}else{echo '';} @endphp" /></p>
                </div>
                <p class="text-sm font-bold">Consultant Haematologist,</p>
                <p class="text-sm font-bold mt-3">Request for a blood picture.</p>
            </div>
            <div class="flex items-center space-x-3 mt-3">
                <select name="b_title" id="b_title" class="border border-gray-400 rounded-md p-1">
                    <option value="" selected disabled>~~Select Title~~</option>
                    <option value="Mr." @php if(session('b_title') == "Mr."){echo 'selected';}else{echo ''; } @endphp>Mr.</option>
                    <option value="Mrs." @php if(session('b_title') == "Mrs."){echo 'selected';}else{echo ''; } @endphp>Mrs.</option>
                    <option value="Miss." @php if(session('b_title') == "Miss."){echo 'selected';}else{echo '';} @endphp>Miss.</option>
                    <option value="Rev." @php if(session('b_title') == "Rev."){echo 'selected';}else{echo '';} @endphp>Rev.</option>
                </select>
                <input type="text" name="b_name" id="b_name" class="border border-gray-400 rounded-md p-1 w-[85%]" value="@php if(session('b_name')){echo session('b_name');}else{echo '';} @endphp">
            </div>
            <div class="mt-2 w-full flex items-center space-x-2">
                <p class="flex text-sm font-bold"><input type="text" name="b_age" class="border border-gray-400 rounded-md p-1" value="@php if(session('b_age')){echo session('b_age');}else{echo '';} @endphp" /> &nbsp;years, </p>
                <p class="flex text-sm font-bold"><input type="text" name="b_address" id="b_address" class="border border-gray-400 p-1 rounded-md w-[95%]" value="@php if(session('b_address')){echo session('admission_address');}else{echo '';} @endphp" /></p>
            </div>
            <div class="w-full mt-3" style="line-height: 1.5">
                <div class="flex  mb-2 space-x-2">
                    <p class="text-sm font-bold">Kindly arrange a blood picture of this patient.</p>
                </div>
                <p class="text-sm font-bold">Clinical History</p>
                {{-- <textarea name="b_history" id="b_history" cols="30" rows="5" class="w-full rounded-md border border-gray-400 p-1">@php if(session('b_history')){echo session('b_history');}else{echo '';} @endphp</textarea> --}}
                <div class="w-[150px]">
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>Pale</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="Pale">
                    </div>
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>Thrombocytopenia</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="Thrombocytopenia">
                    </div>
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>LN</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="LN">
                    </div>
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>Hepatomegaly</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="Hepatomegaly">
                    </div>
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>Spleenomegaly</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="Spleenomegaly">
                    </div>
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>Bleeding</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="Bleeding">
                    </div>
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>Drugs</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="Drugs">
                    </div>
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>Co morbids</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="Co morbids">
                    </div>
                    <div class="flex space-x-1 items-center justify-between">
                        <p class="text-sm font-bold">
                            <span>Other</span>
                        </p>
                        <input type="checkbox" name="b_history[]" id="b_hostory" class="" value="Other">
                    </div>
                </div>
            </div>
            <div class="w-full mt-[50px]" style="line-height: 2;">
                <p class="text-sm font-bold">Thank You,</p>
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
                    <a href="{{ route('letters.blood-picture-clear') }}" type="button" class="justify-center w-[56px] h-[56px] text-gray-500 bg-white rounded-lg border border-gray-200 dark:border-gray-600 hover:text-azure-radiance-500 shadow-sm  dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400 px-2 py-2">
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
