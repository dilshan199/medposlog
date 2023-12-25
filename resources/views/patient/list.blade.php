@extends('layouts.master')

@section('title', 'MedOne | Patients List')

@section('content')
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
                    <span class="font-medium text-azure-radiance-500">Patient List</span>
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
    {{-- <form action="{{ route('patient.patient-search') }}" method="post">
        @csrf
        <div class="mt-3 grid grid-cols-4 gap-2 px-2 py-2 bg-azure-radiance-50 rounded-md shadow-sm">
            <div>
                <label for="patient_no" class="text-sm font-medium text-gray-600">Patient No</label>
                <input type="text" name="patient_id" id="patient_id" class="w-full rounded-md border border-gray-400 p-1" value="" autocomplete="off">
            </div>
            <div>
                <label for="nic" class="text-sm font-medium text-gray-600">NIC</label>
                <input type="text" name="nic" id="nic" class="w-full rounded-md border border-gray-400 p-1" value="">
            </div>
            <div>
                <label for="contact_no" class="text-sm font-medium text-gray-600">Phone No</label>
                <input type="tel" name="contact_no" id="contact_no" class="w-full rounded-md border border-gray-400 p-1" value="">
            </div>
            <div>
                <button type="submit" name="search" value="Search" class="p-1 mt-6 w-full rounded-md bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white font-medium">
                    <i class="bi bi-search"></i>
                    <span>Search</span>
                </button>
            </div>
        </div>
    </form> --}}
    <div class="w-full mt-3 bg-white rounded-md shadow-sm px-2 py-2">
        <form action="{{ route('patient.patient-search') }}" method="post" class="mb-3">
            @csrf
            <div class="flex items-center justify-end">
                <span class="p-2.5 bg-gray-100 rounded-s-md text-lg text-azure-radiance-600">
                    <i class="bi bi-upc-scan"></i>
                </span>
                <input type="text" name="q" id="q" class="border border-s-0 border-e-0 border-gray-300 w-[30%] p-2.5 placeholder:text-sm focus:border-gray-300" value="" autocomplete="" placeholder="Scan barcode or Type Patient ID, NIC or Phone no" autofocus>
                <button type="submit" name="search" value="Search" class="text-base bg-azure-radiance-500 hover:bg-azure-radiance-400 text-white rounded-e-md p-2.5">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        @if (count($patient) > 0)
            <table class="w-full border border-gray-400 text-sm">
                <thead>
                    <th class="p-1 border border-gray-300">ID</th>
                    <th class="p-1 border border-gray-300">Title</th>
                    <th class="p-1 border border-gray-300">Patient Name</th>
                    <th class="p-1 border border-gray-300">NIC</th>
                    <th class="p-1 border border-gray-300">Contact No</th>
                    <th class="p-1 border border-gray-300">Age</th>
                    <th class="p-1 border border-gray-300">Action</th>
                </thead>
                <tbody>
                    @foreach ($patient as $pa)
                        <tr>
                            <td class="p-1 border border-gray-300">{{ $pa->patient_id }}</td>
                            <td class="p-1 border border-gray-300">{{ $pa->title }}</td>
                            <td class="p-1 border border-gray-300">{{ $pa->name }}</td>
                            <td class="p-1 border border-gray-300">{{ $pa->nic }}</td>
                            <td class="p-1 border border-gray-300">{{ $pa->contact_no }}</td>
                            <td class="p-1 border border-gray-300 text-center">{{ $pa->age }}</td>
                            <td class="p-1 border border-gray-300">
                                <ul class="flex item-center space-x-3 justify-center">
                                    <li>
                                        <a type="button" id="editButton" data-url="{{ route('patient.edit', $pa->patient_id) }}" class="text-gray-400 hover:text-azure-radiance-500 cursor-pointer"><i class="bi bi-pencil-square"></i>&nbsp;Edit</a>
                                    </li>
                                </ul>
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
                <p class="text-center text-xs font-normal text-gray-400">Create or add new records to view</p>
            </div>
        @endif
    </div>

    <!-- Start page footer -->
    <div class="w-full py-3">
        <p class="text-xs font-normal text-gray-500 text-center">MedOne&copy;2023. Software By: All In One Solutions.</p>
    </div>
    <!-- End page footer -->

    <!-- Strat edit model -->
    <!-- Main modal -->
    <div id="editModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-10 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full edit-model bg-azure-radiance-800/30">
        <div class="relative w-full max-w-md max-h-full m-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-24">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-2 border-b border-gray-300 rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Patient
                    </h3>
                    <button type="button" id="closeBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <i class="bi bi-x-lg"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="" method="post">
                    <div class="px-6 py-2 space-y-6">
                        <input type="hidden" name="patient_id" id="patient_id_2" value="">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="w-full mb-3">
                            <label for="title" class="text-sm font-medium text-gray-600">Title </label>
                            <select name="title" id="title_2" class="rounded-md border border-gray-400 w-full p-1">
                                <option value=""></option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Rev.">Rev.</option>
                            </select>
                        </div>
                        <div class="w-full mb-3">
                            <label for="name" class="text-sm font-medium w-full">Name</label>
                            <input type="text" name="name" id="name_2" class="p-1 rounded-md w-full" value="">
                        </div>
                        <div class="w-full mb-3">
                            <label for="nic" class="text-sm font-medium w-full">NIC</label>
                            <input type="text" name="nic" id="nic_2" class="p-1 rounded-md w-full" value="">
                        </div>
                        <div class="w-full mb-3">
                            <label for="dosage" class="text-sm font-medium w-full">Phone No</label>
                            <input type="text" name="contact_no" id="contact_no_2" class="p-1 rounded-md w-full" value="">
                        </div>
                        <div class="w-full mb-3">
                            <label for="address" class="text-sm font-medium w-full">Address</label>
                            <input type="text" name="address" id="address_2" class="p-1 rounded-md w-full" value="">
                        </div>
                        <div class="w-full mb-3">
                            <label for="age" class="text-sm font-medium w-full">Age</label>
                            <input type="text" name="age" id="age_2" class="p-1 rounded-md w-full" value="">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" id="updateCategory" class="text-white bg-azure-radiance-500 hover:bg-azure-radiance-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                        <button  type="button" id="closeBtn_2" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End of edit model --}}

    <script src="{{ asset('js/patient-update.js') }}" type="text/javascript"></script>
@endsection
