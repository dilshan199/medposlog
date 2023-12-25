@extends('layouts.master')

@section('title', 'Welcome to MedOne Patient Management System')

@section('content')
    <!-- Start breadcrumb -->
    <div class="w-full">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-normal text-gray-600">Dashboard</h2>
            @if (session('success'))
                <div id="alert-3" class="flex items-center p-4 mb-4 text-azure-radiance-700 rounded-lg bg-azure-radiance-50" role="alert">
                    <i class="bi bi-check2-circle"></i>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-azure-radiance-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-azure-radiance-100 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif
            @if (session('warning'))
                <div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ session('warning') }}
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
    <div class="w-full mt-3">
        <div class="grid grid-cols-4 gap-4">
            <div class="px-2 py-2 rounded-md shadow-sm bg-alizarin-crimson-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h6 class="text-sm text-white font-normal">Today Registred</h6>
                        <h1 class="text-3xl text-white font-normal">
                            @if ($total_registerd > 0)
                                {{ $total_registerd}}
                            @else
                                @php
                                    echo '0';
                                @endphp
                            @endif
                        </h1>
                    </div>
                    <i class="bi bi-calendar2-check text-5xl text-white"></i>
                </div>
            </div>
            <div class="px-2 py-2 rounded-md shadow-sm bg-azure-radiance-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h6 class="text-sm text-white font-normal">Visited Patients</h6>
                        <h1 class="text-3xl text-white font-normal">
                            @if ($total_visited > 0)
                                {{ $total_visited}}
                            @else
                                @php
                                    echo '0';
                                @endphp
                            @endif
                        </h1>
                    </div>
                    <i class="bi bi-people text-5xl text-white"></i>
                </div>
            </div>
            <div class="px-2 py-2 rounded-md shadow-sm bg-azure-radiance-400">
                <div class="flex items-center justify-between">
                    <div>
                        <h6 class="text-sm text-white font-normal">Not Visit</h6>
                        <h1 class="text-3xl text-white font-normal">
                            @if ($total_not_visited > 0)
                                {{ $total_not_visited}}
                            @else
                                @php
                                    echo '0';
                                @endphp
                            @endif
                        </h1>
                    </div>
                    <i class="bi bi-person-x text-5xl text-white"></i>
                </div>
            </div>
            <div></div>
        </div>
        <div class="grid grid-cols-4 gap-4 mt-3">
            <div class="col-span-3 bg-white rounded-md shadow-sm">
                <div class="border-b border-b-gray-400 px-2 py-3 flex items-center justify-between">
                    <h5 class="text-lg font-medium">Today Check List</h5>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="px-2 py-2">
                    @if (count($patient) > 0)
                        <table class="border border-gray-400 w-full text-sm">
                            <thead>
                                <th class="text-sm p-1 text-center border border-gray-400">Patient ID</th>
                                <th class="text-sm p-1 text-center border border-gray-400">Name</th>
                                <th class="text-sm p-1 text-center border border-gray-400">NIC</th>
                                <th class="text-sm p-1 text-center border border-gray-400">Contact No</th>
                                <th class="text-sm p-1 text-center border border-gray-400">Status</th>
                            </thead>
                            <tbody>
                                @foreach ($patient as $pa)
                                    <tr>
                                        <td class="border border-gray-400 p-1">{{ $pa->patient_id }}</td>
                                        <td class="border border-gray-400 p-1">{{ $pa->name }}</td>
                                        <td class="border border-gray-400 p-1">{{ $pa->nic }}</td>
                                        <td class="border border-gray-400 p-1">{{ $pa->contact_no }}</td>
                                        <td class="text-center border border-gray-400 p-1">
                                            @if ($pa->check_status == 1)
                                                <span class="p-1 rounded-sm bg-azure-radiance-100 text-azure-radiance-600 font-medium text-xs">Visited</span>
                                            @else
                                                <span class="p-1 rounded-sm bg-alizarin-crimson-100 text-alizarin-crimson-600 font-medium text-xs">Not Visit</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $patient->links() }}
                        </div>
                    @else
                        <div class="mt-5">
                            <h5 class="text-md font-bold text-center text-gray-600">No Any Records To View</h5>
                            <p class="text-center text-xs font-normal text-gray-400">No any patinet register today</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End page content -->

    <!-- Start page footer -->
    <div class="w-full py-3">
        <p class="text-xs font-normal text-gray-500 text-center">MedOne&copy;2023. Software By: All In One Solutions.</p>
    </div>
    <!-- End page footer -->
@endsection
