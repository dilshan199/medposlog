@extends('layouts.master')

@section('title', 'MedOne | Patient Information Form')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Start breadcrumb -->
    <div class="w-full">
        <div class="flex items-center justify-between">
            <ul class="flex text-sm text-gray-600 font-normal space-x-1">
                <li>
                    <a href="{{ route('welcome') }}" class="hover:text-azure-radiance-500"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li>
                    <span>/&nbsp;Patient&nbsp;/</span>
                </li>
                <li>
                    <span class="font-medium text-azure-radiance-500">Patient Information form</span>
                </li>
            </ul>
            @if (session('success'))
                <div id="alert-3" class="flex items-center p-4 mb-4 text-azure-radiance-700 rounded-lg bg-azure-radiance-50" role="alert">
                    <i class="bi bi-check2-circle"></i>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-azure-radiance-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-azure-radiance-100 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <i class="bi bi-x-circle"></i>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {!! session('error') !!}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif
            @if (session('warning'))
                <div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {!! session('warning') !!}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700" data-dismiss-target="#alert-4" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <!-- End breadcrumb -->
    <!-- Start page content -->
    <div class="w-full mt-3 bg-white p-3 rounded-md">
        <div class="w-full mb-3">
            <form action="{{ route('patient.search') }}" method="post">
                @csrf
                <div class="flex items-center justify-end">
                    <span class="p-2.5 bg-gray-100 rounded-s-md text-lg text-azure-radiance-600">
                        <i class="bi bi-upc-scan"></i>
                    </span>
                    <input type="text" name="q" id="q" class="border border-s-0 border-e-0 border-gray-300 w-[30%] p-2.5 placeholder:text-sm focus:border-gray-300" value="" autocomplete="" placeholder="Scan barcode or type Patient ID, NIC or Phone no" autofocus>
                    <button type="submit" name="search" value="Search" class="text-base bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white rounded-e-md p-2.5">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="w-full">
            <form action="{{ route('patient.resgister') }}" method="post">
                @csrf
                <div class="grid grid-cols-2 gap-2">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="flex items-center">
                                <label for="patient_id" class="text-sm font-medium text-gray-600">Patient No</label>
                                <input type="text" name="patient_id" id="patient_id" class="border-0 p-1 text-center text-lg font-bold" value="@php if(session('patient_id_1')){ echo session('patient_id_1'); }else{ echo $patient_id ;} @endphp" readonly>
                            </div>
                            <div class="flex items-center space-x-1 mb-3">
                                 <div>
                                    <label for="title" class="text-sm font-medium text-gray-600">Title <span class="text-alizarin-crimson-500">*</span></label>
                                    <select name="title" id="title" class="rounded-md border border-gray-400 w-full p-1" required>
                                        <option value=""></option>
                                        <option value="Mr." @php if(session('title_1') == "Mr."){echo 'selected';}else{echo ''; } @endphp>Mr.</option>
                                        <option value="Mrs." @php if(session('title_1') == "Mrs."){echo 'selected';}else{echo ''; } @endphp>Mrs.</option>
                                        <option value="Miss." @php if(session('title_1') == "Miss."){echo 'selected';}else{echo '';} @endphp>Miss.</option>
                                        <option value="Rev." @php if(session('title_1') == "Rev."){echo 'selected';}else{echo '';} @endphp>Rev.</option>
                                    </select>
                                 </div>
                                 <div>
                                    <label for="name" class="text-sm font-medium text-gray-600">Name <span class="text-alizarin-crimson-500">*</span></label>
                                    <input type="text" name="name" id="name" class="p-1 w-full border border-gray-400 rounded-md" value="@php if(session('name_1')){ echo session('name_1'); }else{ echo '';} @endphp" required>
                                 </div>
                            </div>
                            <div class="w-full mb-3">
                                <label for="nic" class="text-sm font-medium text-gray-600">NIC</label>
                                <input type="text" name="nic" id="nic" class="p-1 w-full border border-gray-400 rounded-md" value="@php if(session('nic_1')){ echo session('nic_1'); }else{ echo '';} @endphp">
                            </div>
                            <div class="w-full mb-3">
                                <label for="contact_no" class="text-sm font-medium text-gray-600">Phone No</label>
                                <input type="tel" name="contact_no" id="contact_no" class="p-1 w-full border border-gray-400 rounded-md" value="@php if(session('contact_no_1')){ echo session('contact_no_1'); }else{ echo '';} @endphp">
                            </div>
                        </div>
                        <div>
                            <div class="w-full mb-3">
                                <label for="address" class="text-sm font-medium text-gray-600">Address</label>
                                <input type="text" name="address" id="address" class="p-1 w-full border border-gray-400 rounded-md" value="@php if(session('address_1')){ echo session('address_1'); }else{ echo '';} @endphp">
                            </div>
                            <div class="flex items-center space-x-1 mb-3">
                                <div class="w-full">
                                    <label for="age" class="text-sm font-medium text-gray-600">Age <span class="text-alizarin-crimson-500">*</span></label>
                                    <input type="text" name="age" id="age" class="p-1 w-full border border-gray-400 rounded-md" value="@php if(session('age_1')){ echo session('age_1'); }else{ echo '';} @endphp" required>
                                </div>
                                <div class="w-full">
                                    <label for="kg" class="text-sm font-medium text-gray-600">KG</label>
                                    <input type="text" name="kg" id="kg" class="rounded-md p-1 border-gray-400 w-full" value="@php if(session('kg_1')){ echo session('kg_1'); }else{ echo '';} @endphp" autocomplete="off">
                                </div>
                            </div>
                            <div class="w-full mb-3">
                                <label for="allegic" class="text-sm font-medium text-gray-600">Allegic</label>
                                <div class="flex items-center space-x-4 mb-2">
                                    <div class="flex items-center justify-start space-x-3">
                                        <input type="radio" name="allegic_status" id="allegic_status" value="Yes" @php if(session('allegic_status_1') == "Yes"){echo 'checked';}else{echo ''; } @endphp>
                                        <label for="allegic_status" class="text-sm font-medium text-gray-600">Yes</label>
                                    </div>
                                    <div class="flex items-center justify-start space-x-3">
                                        <input type="radio" name="allegic_status" id="allegic_status" value="No" @php if(session('allegic_status_1') == "No"){echo 'checked';}else{ echo ''; } @endphp>
                                        <label for="allegic_status" class="text-sm font-medium text-gray-600">No</label>
                                    </div>
                                </div>
                                <textarea name="allegic_des" id="allegic_des" cols="30" rows="3" class="rounded-md border-gray-400 w-full" disabled>@php if(session('allegic_des_1')){ echo session('allegic_des_1'); }else{ echo '';} @endphp</textarea>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <div class="w-full mb-3" id="todayInvestigation" style="display: block">
                                    <label for="investigation" class="text-sm font-medium text-gray-600">Today Investigation</label>
                                    <div class="flex items-center">
                                        <input type="text" id="investigation" class="border-gray-400 p-[5px] text-sm w-full" value="" autocomplete="off" placeholder="Search Investigation">
                                        <button type="button" id="searchInvestigation" name="search_investigation" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                    <div class="w-full h-[200px] overflow-y-scroll overflow-x-hidden">
                                        <table id="investigationTable"  class="w-full investigation">
                                            @foreach ($investigation as $inv)
                                                <tr>
                                                    <td class="border border-gray-400 p-1 text-sm text-gray-600 cursor-pointer hover:bg-gray-100">{{ $inv->investigation }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="w-full mb-3 mt-3">
                                    <textarea name="investigation" id="investigation_3" cols="30" rows="10" placeholder="Today Investigation" class="w-full border border-gray-400 p-1 rounded-md text-sm click-in-txt">@php if(session('investigation_1')){ echo session('investigation_1'); }else{ echo '';} @endphp</textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <button type="submit" name="submit" value="Add Patient" class="w-full p-2 rounded-md bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white font-medium space-x-1">
                                            <i class="bi bi-person-add"></i>
                                            <span>Register</span>
                                        </button>
                                    </div>
                                    <div>
                                        <a href="{{ route('patient.clear-form') }}" class="flex items-center space-x-1 justify-center border border-gray-400 text-gray-600 hover:bg-gray-600 hover:text-white rounded-md p-2">
                                            <i class="bi bi-x-lg"></i>
                                            <span>Clear Form</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End page content -->

    <!-- Start page footer -->
    <div class="w-full py-3">
        <p class="text-xs font-normal text-gray-500 text-center">MedOne&copy;2023. Software By: All In One Solutions.</p>
    </div>
    <!-- End page footer -->

    <script type="text/javascript">
        $('input:radio[name="allegic_status"]').change(function() {
            $('textarea[name="allegic_des"]').prop("disabled", $(this).val() != 'Yes');
        }).filter(':checked').trigger('change');
    </script>
    <script src="{{ asset('js/get-investigation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-investigation-table.js') }}" type="text/javascript"></script>
@endsection
