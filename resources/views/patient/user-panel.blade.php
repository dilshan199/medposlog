@extends('layouts.master')

@section('title', 'Medposlog | Patient Information Form')

@section('content')
    <!-- Start breadcrumb -->
    <div class="w-full">
        <div class="flex items-center justify-between">
            <ul class="flex text-sm text-gray-600 font-normal space-x-1">
                <li>
                    <a href="#" class="hover:text-azure-radiance-500"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li>
                    <span>/&nbsp;Patient&nbsp;/</span>
                </li>
                <li>
                    <span class="font-medium text-azure-radiance-500">Patient Information form</span>
                </li>
            </ul>
        </div>
    </div>
    <!-- End breadcrumb -->
    <!-- Start page content -->
    <div class="w-full mt-3">
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2 bg-white shadow-sm rounded-md">
                <form action="" method="post">
                    @csrf
                    <div class="grid grid-cols-2 gap-2">
                        <div class="px-2 py-2">
                            <div class="w-full mb-3">
                                <label for="patient_no" class="text-sm font-medium text-gray-600">Patient No</label>
                                <input type="text" name="patient_id" id="patient_id" class="border-0 p-1 text-center text-lg font-bold" value="{{ $patient_id }}" readonly>
                            </div>
                            <div class="w-full mb-3">
                                <label for="name" class="text-sm font-medium text-gray-600">Name <span class="text-alizarin-crimson-500">*</span></label>
                                <input type="text" name="name" id="name" class="p-1 w-full border border-gray-400 rounded-md" value="" required>
                            </div>
                            <div class="w-full mb-3">
                                <label for="nic" class="text-sm font-medium text-gray-600">NIC <span class="text-alizarin-crimson-500">*</span></label>
                                <input type="text" name="nic" id="nic" class="p-1 w-full border border-gray-400 rounded-md" value="" required>
                            </div>
                            <div class="w-full mb-3">
                                <label for="contact_no" class="text-sm font-medium text-gray-600">Phone No <span class="text-alizarin-crimson-500">*</span></label>
                                <input type="tel" name="contact_no" id="contact_no" class="p-1 w-full border border-gray-400 rounded-md" value="" required>
                            </div>
                        </div>
                        <div class="px-2 py-2">
                            <div class="w-full mb-3">
                                <label for="sh" class="text-sm font-medium text-gray-600">S/H</label>
                                <input type="text" name="sh" id="sh" class="p-1 w-full border border-gray-400 rounded-md" value="">
                            </div>
                            <div class="w-full mb-3">
                                <label for="kg" class="text-sm font-medium text-gray-600">KG</label>
                                <input type="text" name="kg" id="kg" class="p-1 w-full border border-gray-400 rounded-md" value="">
                            </div>
                            <div class="w-full mb-3">
                                <label for="bp" class="text-sm font-medium text-gray-600">BP</label>
                                <input type="text" name="bp" id="bp" class="p-1 w-full border border-gray-400 rounded-md" value="">
                            </div>
                            <div>
                                <button type="submit" name="submit" value="Add Patient" class="w-full p-2 rounded-md bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white font-medium space-x-1">
                                    <i class="bi bi-plus-lg"></i>
                                    <span>Add Patient</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="rounded-md shadow-sm bg-azure-radiance-50 px-2 py-3">
                <h6 class="text-lg font-medium text-gray-600">Search Patient Here</h6>
                <form action="" method="post">
                    @csrf
                    <div class="w-full mb-3">
                        <label for="patient_no" class="text-sm font-medium text-gray-600">Patient No</label>
                        <input type="text" name="patient_no" id="patient_no" class="w-full rounded-md border border-gray-400 p-1" value="" autocomplete="off">
                    </div>
                    <div class="w-full mb-3">
                        <label for="nic" class="text-sm font-medium text-gray-600">NIC</label>
                        <input type="text" name="nic" id="nic" class="w-full rounded-md border border-gray-400 p-1" value="">
                    </div>
                    <div class="w-full mb-3">
                        <label for="contact_no" class="text-sm font-medium text-gray-600">Phone No</label>
                        <input type="tel" name="contact_no" id="contact_no" class="w-full rounded-md border border-gray-400 p-1" value="">
                    </div>
                    <div>
                        <button type="submit" name="search" value="Search" class="p-1 w-full rounded-md bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white font-medium">
                            <i class="bi bi-search"></i>
                            <span>Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End page content -->

    <!-- Start page footer -->
    <div class="w-full py-3">
        <p class="text-xs font-normal text-gray-500 text-center">Medposlog&copy;2023. Software By: All In One Holding.</p>
    </div>
    <!-- End page footer -->
@endsection
