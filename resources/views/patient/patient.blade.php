@extends('layouts.master')

@section('title', 'MedOne | Patient and Drug issuing form')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
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
                    <span class="font-medium text-azure-radiance-500">Patient and Drug issuing form</span>
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
        </div>
    </div>
    <!-- End breadcrumb -->

    <!-- Start page content -->
    <div class="w-full mt-3">
        <div class="grid grid-cols-5 gap-2">
            <div class="col-span-2">
                <form action="{{ route('patient.history') }}" method="post">
                    @csrf
                    <div class="px-3 py-3 bg-azure-radiance-50 rounded-md shadow-sm">
                        <div class="border-b border-b-azure-radiance-200 flex items-center justify-between">
                            <h6 class="text-lg font-medium text-gray-600 mb-1">Search Patient</h6>
                            <button type="submit" name="search" value="Search" class="p-1 rounded-md shadow-md bg-azure-radiance-600 hover:bg-azure-radiance-500 text-white font-medium text-sm space-x-1 -mt-2 w-[25%]">
                                <i class="bi bi-search"></i>
                                <span>Search</span>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="patient_id" class="text-sm font-medium text-gray-500">Patient ID</label>
                                <input type="text" name="patient_id" id="patient_id_1" onkeyup="getPrevoiusDate(this.value)" class="p-1 border border-gray-300 w-full rounded-md" value="" autocomplete="off">
                            </div>
                            <div>
                                <label for="prevoius_date" class="text-sm font-medium text-gray-500">Previous Date</label>
                                <select name="check_date" id="check_date_1" class="p-1 border border-gray-300 rounded-md w-full"></select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nic" class="text-sm font-medium text-gray-500">NIC</label>
                                <input type="text" name="nic" id="nic_1" class="p-1 border border-gray-300 w-full rounded-md" value="" autocomplete="off">
                            </div>
                            <div>
                                <label for="contact_no" class="text-sm font-medium text-gray-500">Phone No</label>
                                <input type="tel" name="contact_no" id="contact_no_1" class="p-1 border border-gray-300 w-full rounded-md" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Start add to cart form -->
                <form action="{{ route('patient.add-to-cart') }}" method="post" id="prescriptionForm">
                    @csrf
                    <div class="w-full px-3 py-3 rounded-md mt-1 shadow-sm bg-white">
                        <div class="border-b border-b-gray-300 flex items-center justify-between">
                            <h6 class="text-lg font-medium text-gray-600 mb-1">Patient Information</h6>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-2">
                            <div>
                                <label for="patient_id" class="text-sm font-medium text-gray-500">Patient ID</label>
                                <input type="text" name="patient_id" id="patient_id" class="p-1 border-0 text-center font-bold text-base w-full bg-azure-radiance-100 rounded-md" value="@php if(session('patient_id')){ echo session('patient_id'); }else{ echo $patient_id;} @endphp" readonly>
                            </div>
                            <div class="flex items-center space-x-1">
                                <div class="">
                                    <label for="title" class="text-sm font-medium text-gray-500">Title <span class="text-red-600">*</span></label>
                                    <select name="title" id="title" class="rounded-md border border-gray-300 w-full p-1" required>
                                        <option value=""></option>
                                        <option value="Mr." @php if(session('title') == "Mr."){echo 'selected';}else{echo ''; } @endphp>Mr.</option>
                                        <option value="Mrs." @php if(session('title') == "Mrs."){echo 'selected';}else{echo ''; } @endphp>Mrs.</option>
                                        <option value="Miss." @php if(session('title') == "Miss."){echo 'selected';}else{echo '';} @endphp>Miss.</option>
                                        <option value="Rev." @php if(session('title') == "Rev."){echo 'selected';}else{echo '';} @endphp>Rev.</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="name" class="text-sm font-medium text-gray-500">Name <span class=" text-alizarin-crimson-600">*</span></label>
                                    <input type="text" name="name" id="name" class="p-1 border border-gray-300 w-full rounded-md" autocomplete="off" value="@php if(session('name')){ echo session('name'); }else{ echo '';} @endphp" required>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-2">
                            <div>
                                <label for="nic" class="text-sm font-medium text-gray-500">NIC</label>
                                <input type="text" name="nic" id="nic" class="p-1 border border-gray-300 w-full rounded-md" autocomplete="off" value="@php if(session('nic')){ echo session('nic'); }else{ echo '';} @endphp">
                            </div>
                            <div>
                                <label for="contact_no" class="text-sm font-medium text-gray-500">Phone No</label>
                                <input type="tel" name="contact_no" id="contact_no" class="p-1 border border-gray-300 w-full rounded-md" autocomplete="off" value="@php if(session('contact_no')){ echo session('contact_no'); }else{ echo '';} @endphp">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="age" class="text-sm font-medium text-gray-500">Age <span class="text-alizarin-crimson-600">*</span></label>
                                <input type="text" name="age" id="age" class="p-1 border border-gray-300 w-full rounded-md" autocomplete="off" value="@php if(session('age')){ echo session('age'); }else{ echo '';} @endphp" required>
                            </div>
                            <div>
                                <label for="address" class="text-sm font-medium text-gray-500">Address</label>
                                <input type="text" name="address" id="address" class="p-1 border border-gray-300 w-full rounded-md" autocomplete="off" value="@php if(session('address')){ echo session('address'); }else{ echo '';} @endphp">
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-3 py-3 rounded-md mt-1 shadow-sm bg-white">
                        <div class="border-b border-b-gray-300 flex items-center justify-between">
                            <h6 class="text-lg font-medium text-gray-600 mb-1">Data</h6>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div class="w-full mb-3">
                                <label for="allegic" class="text-sm font-medium text-gray-500">Allegic</label>
                                <div class="flex items-center space-x-4 mb-2">
                                    <div class="flex items-center justify-start space-x-3">
                                        <input type="radio" name="allegic_status" id="allegic_status" value="Yes" @php if(session('allegic_status') == "Yes"){echo 'checked';}else{echo ''; } @endphp>
                                        <label for="allegic_status" class="text-sm font-medium text-gray-600">Yes</label>
                                    </div>
                                    <div class="flex items-center justify-start space-x-3">
                                        <input type="radio" name="allegic_status" id="allegic_status" value="No" @php if(session('allegic_status') == "No"){echo 'checked';}else{ echo ''; } @endphp>
                                        <label for="allegic_status" class="text-sm font-medium text-gray-600">No</label>
                                    </div>
                                </div>
                                <textarea name="allegic_des" id="allegic_des" cols="30" rows="2" class="rounded-md border-gray-300 w-full" disabled>@php if(session('allegic_des')){ echo session('allegic_des'); }else{ echo '';} @endphp</textarea>
                            </div>
                            <div>
                                <div class="w-full">
                                    @php
                                        $current_date = "";
                                        $current_date = Carbon::now('Asia/Colombo')->format('Y-m-d');
                                    @endphp
                                    <input type="hidden" name="check_date" id="check_date" class="p-1 rounded-md border border-gray-300 w-full" value="@php if(session('check_date')){echo session('check_date');}else{echo $current_date; } @endphp" required readonly>
                                </div>
                                <div class="w-full mb-2">
                                    <label for="kg" class="text-sm font-medium text-gray-600">KG</label>
                                    <input type="text" name="kg" id="kg" class="rounded-md p-1 border-gray-300 w-full" value="@php if(session('kg')){ echo session('kg'); }else{ echo '';} @endphp" autocomplete="off">
                                </div>
                                <div class="w-full mb-2">
                                    <label for="bp" class="text-sm font-medium text-gray-600">BP</label>
                                    <input type="text" name="bp" id="bp" class="rounded-md p-1 border-gray-300 w-full" value="@php if(session('bp')){ echo session('bp'); }else{ echo '';} @endphp" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="bg-white">
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
                                <div class="w-full mb-3" id="nextVisit" style="display: none">
                                    <label for="investigation" class="text-sm font-medium text-gray-600">Next Visit Inx</label>
                                    <div class="flex items-center">
                                        <input type="text" id="nextVisit" class="border-gray-400 p-[5px] text-sm w-full" value="" autocomplete="off" placeholder="Search Next Visit">
                                        <button type="button" id="searchNInvestigation" name="search_n_investigation" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                    <div class="w-full h-[200px] overflow-y-scroll overflow-x-hidden">
                                        <table id="NinvestigationTable" class="w-full">
                                            @foreach ($investigation as $inv)
                                                <tr>
                                                    <td class="border border-gray-400 p-1 text-sm text-gray-600 cursor-pointer hover:bg-gray-100">{{ $inv->investigation }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="w-full" id="problemList" style="display: block">
                                    <label for="problem" class="text-sm font-medium text-gray-600">Problems</label>
                                    <div class="flex items-center">
                                        <input type="text" id="problem" class="border-gray-400 p-[5px] text-sm w-full" value="" autocomplete="off" placeholder="Search Problem">
                                        <button type="button" id="searchproblem" name="search_problem" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                    <div class="w-full h-[280px] overflow-y-scroll overflow-x-hidden">
                                        <table id="problemTable" class="w-full">
                                            @foreach ($problem as $pro)
                                                <tr>
                                                    <td class="border border-gray-400 p-1 text-sm text-gray-600 cursor-pointer hover:bg-gray-100">{{ $pro->problem }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="w-full" id="CproblemList" style="display: none">
                                    <label for="problem" class="text-sm font-medium text-gray-600">Problems</label>
                                    <div class="flex items-center">
                                        <input type="text" id="Cproblem" class="border-gray-400 p-[5px] text-sm w-full" value="" autocomplete="off" placeholder="Search Problem">
                                        <button type="button" id="searchproblem_2" name="search_problem" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                    <div class="w-full h-[150px] overflow-y-scroll overflow-x-hidden">
                                        <table id="CproblemTable" class="w-full">
                                            @foreach ($problem as $pro)
                                                <tr>
                                                    <td class="border border-gray-400 p-1 text-sm text-gray-600 cursor-pointer hover:bg-gray-100">{{ $pro->problem }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="w-full mb-3">
                                    <textarea name="investigation" id="investigation_3" cols="30" rows="5" placeholder="Today Investigation" class="w-full border border-gray-300 p-1 rounded-md text-sm click-in-txt">@php if(session('investigation')){ echo session('investigation'); }else{ echo '';} @endphp</textarea>
                                </div>
                                <div class="w-full mb-3">
                                    <textarea name="next_day_investigation" id="next_day_investigation" cols="30" rows="5" placeholder="Next Visit Inx" class="w-full border border-gray-300 p-1 rounded-md text-sm click-in-txt">@php if(session('next_day_investigation')){ echo session('next_day_investigation'); }else{ echo '';} @endphp</textarea>
                                </div>
                                <div class="w-full mb-3">
                                    <textarea name="problem" id="problem_3" cols="30" rows="5" placeholder="Problems" class="w-full border border-gray-300 p-1 rounded-md text-sm click-in-txt-2">@php if(session('problem')){ echo session('problem'); }else{ echo '';} @endphp</textarea>
                                </div>
                                <div class="w-full mb-3">
                                    <textarea name="current_problem" id="problem_4" cols="30" rows="5" placeholder="Current Problems" class="w-full border border-gray-300 p-1 rounded-md text-sm click-in-txt-2">@php if(session('current_problem')){ echo session('current_problem'); }else{ echo '';} @endphp</textarea>
                                </div>
                                <div class="w-full">
                                    <textarea name="clinic_followup" id="clinic_followup_3" cols="30" rows="5" placeholder="Clinic Followup" class="w-full border border-gray-300 p-1 rounded-md text-sm">@php if(session('clinic_followup')){ echo session('clinic_followup'); }else{ echo '';} @endphp</textarea>
                                </div>
                            </div>
                            <div>
                                <div class="bg-white">
                                    <div class="w-full mb-3">
                                        <label for="note" class="text-sm font-medium text-gray-600">Special Note</label>
                                        <div class="flex items-center">
                                            <input type="text" id="note" class="border-gray-400 p-[5px] text-sm w-full" value="" autocomplete="off" placeholder="Search Note">
                                            <button type="button" id="searchNote" name="search_note" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                        <div class="w-full h-[150px] overflow-y-scroll overflow-x-hidden">
                                            <table id="noteTable" class="w-full">
                                                @foreach ($note as $not)
                                                    <tr>
                                                        <td class="border border-gray-400 p-1 text-sm text-gray-600 cursor-pointer hover:bg-gray-100">{{ $not->note }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    <div class="w-full mb-2">
                                        <textarea name="note" id="note_3" cols="30" rows="4" placeholder="Special Note" class="w-full border border-gray-300 rounded-md p-1 text-sm">@php if(session('note')){ echo session('note'); }else{ echo '';} @endphp</textarea>
                                    </div>
                                    <div class="w-full">
                                        <label for="clinic_followup" class="text-sm font-medium text-gray-600">Clinic Followup</label>
                                        <div class="flex items-center">
                                            <input type="text" id="clinic_followup" class="border-gray-400 p-[5px] text-sm w-full" value="" autocomplete="off" placeholder="Search Clinic Followup">
                                            <button type="button" id="searchClinic" name="search_clinic" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                        <div class="w-full h-[250px] overflow-y-scroll overflow-x-hidden">
                                            <table id="clinicTable" class="w-full">
                                                @foreach ($clinic as $cli)
                                                    <tr>
                                                        <td class="border border-gray-400 p-1 text-sm text-gray-600 cursor-pointer hover:bg-gray-100">{{ $cli->clinic_followup }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" id="update" class="p-1 rounded-md shadow-md bg-azure-radiance-600 hover:bg-azure-radiance-500 text-white font-medium text-sm space-x-1 mt-2 flex items-center">
                                <i class="bi bi-plus-lg"></i>
                                <span>Add Investigation</span>
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-span-3 px-3 py-3 bg-white rounded-md shadow-sm">
                <div class="border-b  flex items-center justify-between">
                    <h6 class="text-lg font-medium text-gray-600 mb-1">Select Drugs</h6>
                </div>
                <div class="grid grid-cols-3 gap-1">
                    <div>
                        <div class="bg-white mt-3">
                            <div class="w-full mb-3">
                                <label for="drug_name" class="text-sm font-medium text-gray-600">Drug Name</label>
                                <div class="flex items-center">
                                    <input type="hidden" id="drug_id_4" value="">
                                    <input type="text" id="drugName" class="border-gray-400 p-[5px] text-sm w-full" autocomplete="off" placeholder="Search Drug">
                                    <button type="button" id="searchDrug" name="search_drug" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                                <div class="w-full h-[350px] overflow-y-scroll overflow-x-hidden">
                                    <table id="drugTable" class="w-full">
                                        @foreach ($normal_drugs as $nd)
                                            <tr onclick="getNormalDrugs(JSON.parse('{{ $nd->drug_id }}'))">
                                                {{-- <form action="" method="post"> --}}
                                                    <input type="hidden" id="drug_id_{{ $nd->drug_id }}" value="{{ $nd->drug_id }}">
                                                    <input type="hidden" id="drug_{{ $nd->drug_id}}" value="{{ $nd->drug_name }}-{{ $nd->dosage }}">
                                                {{-- </form> --}}
                                                <td class="border border-gray-400 p-1 text-base text-gray-600 cursor-pointer hover:bg-gray-100">{{ $nd->drug_name }}-{{ $nd->dosage }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <h6 class="text-lg font-medium text-gray-600 mb-1">Special Drugs</h6>
                            <div class="w-full mt-2">
                                <label for="special_drug_name" class="text-sm font-medium text-gray-600">Drugs Name</label>
                                <div class="flex items-center">
                                    <input type="text" id="drug_name_3" class="border-gray-400 p-[5px] text-sm w-full" value="" autocomplete="off" placeholder="Search Special Drugs">
                                    <button type="button" id="searchDrugSp" name="search_special_drug" class="p-1 bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                                <div class="w-full h-[350px] overflow-y-scroll overflow-x-hidden">
                                    <table id="specialDrugTable" class="w-full">
                                        @foreach ($special_drugs as $sd)
                                            <tr onclick="getSpecialDrugs(JSON.parse('{{ $sd->drug_id }}'))">
                                                {{-- <form action="" method="post"> --}}
                                                    <input type="hidden" id="drug_id_2_{{ $sd->drug_id }}" value="{{ $sd->drug_id }}">
                                                    <input type="hidden" id="drug_{{ $sd->drug_id}}" value="{{ $sd->drug_name }}-{{ $sd->dosage }}">
                                                {{-- </form> --}}
                                                <td class="border border-gray-400 p-1 text-base text-gray-600 cursor-pointer hover:bg-gray-100">{{ $sd->drug_name }}-{{ $sd->dosage }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div>
                                <input type="hidden" name="drug_id" id="drug_id_ori" value="">
                                <div>
                                    <h6 class="text-sm font-medium text-gray-600">Pre Dose</h6>
                                    <div class="w-full mb-1">
                                        <input type="text" name="dose1[]" id="dose_1" class="rounded-md p-1 border-gray-300 w-full" value="" autocomplete="off">
                                    </div>
                                    <div class="w-full mb-1">
                                        <input type="text" name="dose1[]" id="dose_1" class="rounded-md p-1 border-gray-300 w-full" value="" autocomplete="off">
                                    </div>
                                    <div class="w-full mb-1">
                                        <input type="text" name="dose1[]" id="dose_1" class="rounded-md p-1 border-gray-300 w-full" value="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="w-full mb-1">
                                    <label for="frequency" class="text-sm font-medium text-gray-600">Frequency</label>
                                    <select name="frequency1" id="frequency" class="p-1 border-gray-300 w-full rounded-md" onchange="document.forms.prescriptionForm.submit();">
                                        <option value="" selected disabled></option>
                                        @foreach ($frequency as $fre)
                                            <option value="{{ $fre->frequency }}">{{ $fre->frequency }}</option>
                                        @endforeach
                                    </select>
                                    <div class="mt-1">
                                        <h6 class="p-1 bg-azure-radiance-50 font-medium text-sm">Insulin</h6>
                                        <div class="grid grid-cols-3 gap-1 mt-1">
                                            @foreach ($insulin as $ins)
                                                <div>
                                                    <input type="hidden" id="drugId_{{ $ins->drug_id }}">
                                                    <input type="hidden" name="m_drug_name" id="drugName_{{ $ins->drug_id }}" value="{{ $ins->drug_name }}">
                                                    <input type="hidden" name="m_dose_1" id="dose_{{ $ins->drug_id }}" value="20 units">
                                                    <input type="hidden" name="m_dose_2" id="dose_2_{{ $ins->drug_id }}" value="10 units">
                                                    <input type="hidden" name="frequency3" id="frequency_{{ $ins->drug_id }}" value="mane">
                                                    <input type="hidden" name="frequency3" id="frequency_2_{{ $ins->drug_id }}" value="nocte">
                                                    <button type="button" id="{{ $ins->drug_id }}" class="text-white font-medium p-1 bg-alizarin-crimson-600 w-full click-insulin" onclick="document.forms.prescriptionForm.submit();">
                                                        @php
                                                            echo Str::upper(Str::substr($ins->drug_name, 0, 1))
                                                        @endphp
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End add to cart form -->
                        <div class="w-full">
                            <form action="{{ route('patient.prescription') }}" method="post" class="mt-3">
                                @csrf
                                <input type="hidden" name="prescription_id" id="prescription_id" value="@php if(session('prescription_id')){echo session('prescription_id');}else{ echo $prescription_id;} @endphp">
                                <input type="hidden" name="patient_id" value="@php if(session('patient_id')){ echo session('patient_id'); }else{ echo '';} @endphp">
                                <input type="hidden" name="title" value="@php if(session('title')){ echo session('title'); }else{ echo '';} @endphp">
                                <input type="hidden" name="name" value="@php if(session('name')){ echo session('name'); }else{ echo '';} @endphp">
                                <input type="hidden" name="nic" value="@php if(session('nic')){ echo session('nic'); }else{ echo '';} @endphp">
                                <input type="hidden" name="contact_no" value="@php if(session('contact_no')){ echo session('contact_no'); }else{ echo '';} @endphp">
                                <input type="hidden" name="age" value="@php if(session('age')){ echo session('age'); }else{ echo '';} @endphp">
                                <input type="hidden" name="address" value="@php if(session('address')){ echo session('address'); }else{ echo '';} @endphp">
                                <input type="hidden" name="allegic_status" value="@php if(session('allegic_status')){ echo session('allegic_status'); }else{ echo '';} @endphp">
                                <input type="hidden" name="allegic_des" value="@php if(session('allegic_des')){ echo session('allegic_des'); }else{ echo '';} @endphp">
                                <input type="hidden" name="kg" value="@php if(session('kg')){ echo session('kg'); }else{ echo '';} @endphp">
                                <input type="hidden" name="bp" value="@php if(session('bp')){ echo session('bp'); }else{ echo '';} @endphp">
                                <textarea name="investigation" id="" cols="30" rows="10" class="hidden">@php if(session('investigation')){ echo session('investigation'); }else{ echo '';} @endphp</textarea>
                                <textarea name="next_day_investigation" id="" cols="30" rows="10" class="hidden">@php if(session('next_day_investigation')){ echo session('next_day_investigation'); }else{ echo '';} @endphp</textarea>
                                <textarea name="problem" id="" cols="30" rows="10" class="hidden">@php if(session('problem')){ echo session('problem'); }else{ echo '';} @endphp</textarea>
                                <textarea name="current_problem" id="" cols="30" rows="10" class="hidden">@php if(session('current_problem')){ echo session('current_problem'); }else{ echo '';} @endphp</textarea>
                                <textarea name="note" id="" cols="30" rows="10" class="hidden">@php if(session('note')){ echo session('note'); }else{ echo '';} @endphp</textarea>
                                <textarea name="clinic_followup" id="" cols="30" rows="10" class="hidden">@php if(session('clinic_followup')){ echo session('clinic_followup'); }else{ echo '';} @endphp</textarea>
                                @if (session('cart'))
                                    @foreach (session('cart') as $cart)
                                        <input type="hidden" name="row_no" value="{{ $cart['item_no'] }}">
                                        <input type="hidden" name="drug_id[]" value="{{ $cart['drug_id'] }}">
                                        <input type="hidden" name="drug_name[]" value="{{ $cart['drug_name'] }}">
                                        <input type="hidden" name="dose[]" value="{{ $cart['dose'] }}">
                                        <input type="hidden" name="frequency[]" value="{{ $cart['frequency'] }}">
                                        <input type="hidden" name="days[]" value="{{ $cart['days'] }}">
                                    @endforeach
                                @endif
                                @php
                                    $current_date = Carbon::now('Asia/Colombo')->format('Y-m-d');
                                @endphp
                                <input type="hidden" name="check_date" id="check_date_2" value="@php if(session('check_date')){ echo session('check_date');}else{echo $current_date;} @endphp">
                                <div class="grid grid-cols-2 gap-2 ">
                                    <div>
                                        <button type="submit" name="submit" value="Save" class="w-full p-2 rounded-md bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white font-medium space-x-1">
                                            <i class="bi bi-printer"></i>
                                            <span class="text-base">Print</span>
                                        </button>
                                    </div>
                                    <div>
                                        <button id="clearDrop" data-dropdown-toggle="clearDropdown" class="w-full p-2 border border-gray-400 bg-white text-gray-600 font-medium rounded-md hover:bg-gray-600 hover:text-white space-x-1" type="button">
                                            <i class="bi bi-x-lg"></i>
                                            <span class="text-base">Clear</span>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="clearDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                                <li>
                                                    <a href="{{ route('patient.clear-prescription') }}" class="block px-4 py-2 hover:text-azure-radiance-500">Clear Prescription</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('patient.new') }}" class="block px-4 py-2 hover:text-azure-radiance-500">Clear All</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="w-full mt-3">
                            <div class="w-full h-[500px] mt-2 overflow-x-scroll overflow-y-scroll">
                                <table class="w-full border border-gray-300 text-sm text-gray-600">
                                    <thead>
                                        <th class="border border-gray-300 p-1"></th>
                                        <th class="border border-gray-300 p-1">Drug Name</th>
                                        <th class="border border-gray-300 p-1">Dose</th>
                                        <th class="border border-gray-300 p-1">Frequency</th>
                                        <th class="border border-gray-300 p-1">Days</th>
                                    </thead>
                                    <tbody>
                                        @if (session('cart'))
                                            @foreach (session('cart') as $cart)
                                                <tr>
                                                    <td class="border border-gray-300 p-1">
                                                        <a href="{{ route('patient.delete-cart-item', $cart['raw_id']) }}" class="text-sm text-gray-400 hover:text-azure-radiance-500">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td class="border border-gray-300">
                                                        <div class="edit p-1">{{ $cart['drug_name'] }}</div>
                                                        <input type="text" name="drug_name" id="drug_{{ $cart['raw_id'] }}" class="textedit p-1 w-auto" value="">
                                                    </td>
                                                    <td class="border border-gray-300">
                                                        <div class="edit p-1">{{ $cart['dose'] }}</div>
                                                        <input type="text" name="dose" id="dose_{{ $cart['raw_id']}}" class="textedit p-1" value="">
                                                    </td>
                                                    <td class="border border-gray-300 text-center">
                                                        <div class="edit p-1">{{ $cart['frequency'] }}</div>
                                                        <input type="text" name="frequency" id="frequency_{{ $cart['raw_id'] }}" class="textedit p-1" value="">
                                                    </td>
                                                    <td class="border border-gray-300 text-right">
                                                        <div class="edit p-1">{{ $cart['days'] }}</div>
                                                        <input type="text" name="days" id="days_{{ $cart['raw_id'] }}" class="textedit p-1" value="">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{-- </form> --}}
        <!-- End add to cart form -->
        </div>
    </div>
    <!-- End page content -->

    <script src="{{ asset('js/search-drug-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-sp-drug-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-clinic-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-investigation-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-note-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-problem-table.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('input:radio[name="allegic_status"]').change(function() {
            $('textarea[name="allegic_des"]').prop("disabled", $(this).val() != 'Yes');
        }).filter(':checked').trigger('change');
    </script>
    <script src="{{ asset('js/get-problem.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/get-clinic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/get-investigation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/prevoius-date.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/add-investigation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/add-problem.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/add-clinic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/add-note.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/add-normal-drugs.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/add-special-drugs.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/fetch-drugs.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/edit-cart-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/m-insulin.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-next-visit.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/get-next-visit.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/select-box.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/get-c-problem.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/search-c-problem.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/select-box-2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/update.js') }}" type="text/javascript"></script>
@endsection
