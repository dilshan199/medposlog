@extends('layouts.master')

@section('title', 'MedOne | Manage Users')

@section('content')
    <!-- Start breadcrumb -->
    <div class="w-full">
        <div class="flex items-center justify-between">
            <ul class="flex text-sm text-gray-600 font-normal space-x-1">
                <li>
                    <a href="{{ route('welcome') }}" class="hover:text-azure-radiance-500"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li>
                    <span>/&nbsp;Clinic&nbsp;/</span>
                </li>
                <li>
                    <span class="font-medium text-azure-radiance-500">Manage Users</span>
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
        </div>
    </div>
    <!-- End breadcrumb -->

    <!-- Start page content -->
    <div class="w-full rounded-md shadow-md px-3 py-3 bg-white mt-3">
        <form action="{{ route('oauth.store') }}" method="post">
            @csrf
            <div class="grid grid-cols-4 gap-2">
                <div>
                    <label for="user_type" class="w-full font-medium text-sm text-gray-600">User Type <span class="text-red-600">*</span></label>
                    <div>
                        <select name="user_type" id="user_type" class="p-2 rounded-md border-gray-300 w-full">
                            <option value="">~~ Select User Type ~~</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Receptionist">Receptionist</option>
                        </select>
                        <span class="text-xs font-medium text-red-600">{{ $errors->first('user_type') }}</span>
                    </div>
                </div>
                <div>
                    <label for="user_name" class="w-full font-medium text-sm text-gray-600">Username <span class="text-red-600">*</span></label>
                    <div>
                        <input type="text" name="user_name" id="user_name" class="p-2 rounded-md border-gray-300 w-full" autocomplete="off" value="">
                        <span class="text-xs font-medium text-red-600">{{ $errors->first('user_name') }}</span>
                    </div>
                </div>
                <div>
                    <label for="password" class="w-full font-medium text-sm text-gray-600">Password <span class="text-red-600">*</span></label>
                    <div>
                        <input type="password" name="password" id="password" class="p-2 rounded-md border-gray-300 w-full" autocomplete="off" value="">
                        <span class="text-xs font-medium text-red-600">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div>
                    <label for="retype_password" class="w-full font-medium text-sm text-gray-600">Retype Password <span class="text-red-600">*</span></label>
                    <div>
                        <input type="password" name="retype_password" id="retype_password" class="p-2 rounded-md border-gray-300 w-full" autocomplete="off" value="">
                        <span class="text-xs font-medium text-red-600">{{ $errors->first('retype_password') }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" name="submit" value="Create User" class="p-2 rounded-md bg-azure-radiance-500 hover:bg-azure-radiance-300 text-white font-medium">Create User</button>
            </div>
        </form>
        <div class="w-full mt-3">
            @if (count($user) > 0)
                <table class="w-full border border-gray-300 text-sm">
                    <thead>
                        <th class="border border-gray-300 py-1">ID</th>
                        <th class="border border-gray-300">User Type</th>
                        <th class="border border-gray-300">Username</th>
                        <th class="border border-gray-300">Password</th>
                        <th class="border border-gray-300">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($user as $usr)
                            <tr>
                                <td class="border border-gray-300 py-1 px-1">{{ $usr->user_id }}</td>
                                <td class="border border-gray-300 py-1 px-1">{{ $usr->user_type }}</td>
                                <td class="border border-gray-300 py-1 px-1">{{ $usr->user_name }}</td>
                                <td class="border border-gray-300 py-1 px-1">{{ $usr->password }}</td>
                                <td class="border border-gray-300 py-1 px-1">
                                    <ul class="flex item-center space-x-3 justify-center">
                                        <li>
                                            <a type="button" id="editButton" data-url="{{ route('oauth.edit', $usr->user_id) }}" class="text-gray-400 hover:text-azure-radiance-500 cursor-pointer"><i class="bi bi-pencil-square"></i>&nbsp;Edit</a>
                                        </li>
                                        <li>
                                            <a type="button" id="{{ $usr->user_id }}" class="text-gray-400 hover:text-azure-radiance-500 cursor-pointer remove"><i class="bi bi-trash"></i>&nbsp;Delete</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $user->links() }}
                </div>
            @else
                <div class="mt-5">
                    <h5 class="text-md font-bold text-center text-gray-600">No Any Records To View</h5>
                    <p class="text-center text-xs font-normal text-gray-400">Create or add new records to view</p>
                </div>
            @endif
        </div>
    </div>
    <!-- End page content -->

    <!-- Start page footer -->
    <div class="w-full py-3">
        <p class="text-xs font-normal text-gray-500 text-center">MedOne&copy;2023. Software By: All In One Solutions.</p>
    </div>
    <!-- End page footer -->

    {{--Confirm dialog--}}
    <div class="absolute w-full top-0 h-full left-0 close-dialog bg-azure-radiance-800/30" id="confirmDialog">
        <div class="shadow-md bg-white w-96 m-auto mt-36 h-28 rounded-md p-3">
            <p class="text-sm text-slate-500 mt-3">Are you sure to delete this record? This action can't be undo</p>
            <div class="flex justify-end">
                <button type="button" id="confirm" class="rounded-full bg-azure-radiance-500 hover:bg-azure-radiance-400 w-14 text-white text-sm me-3">Yes</button>
                <button type="button" id="cancel" class="rounded-full border border-gray-500 text-gray-500 hover:bg-gray-500 hover:text-white w-14">No</button>
            </div>
        </div>
    </div>
    {{--End confirm dialog--}}

    {{--Edit model --}}

    <!-- Main modal -->
    <div id="editModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-10 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full edit-model bg-azure-radiance-800/30">
        <div class="relative w-full max-w-md max-h-full m-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-24">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b border-gray-300 rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Users
                    </h3>
                    <button type="button" id="closeBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <i class="bi bi-x-lg"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="" method="post">
                    <div class="px-6 py-2 space-y-6">
                        <input type="hidden" name="user_id" id="user_id_2" value="">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="w-full mb-3">
                            <label for="user_type" class="text-sm font-medium w-full">User Type</label>
                            <select name="user_type" id="user_type_2" class="p-1 rounded-md w-full">
                                <option value=""></option>
                                <option value="Administrator">Administrator</option>
                                <option value="Receptionist">Receptionist</option>
                            </select>
                        </div>
                        <div class="w-full mb-3">
                            <label for="user_name" class="text-sm font-medium w-full">Username</label>
                            <input type="text" name="user_name" id="user_name_2" class="p-1 rounded-md w-full" value="">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" id="updateCategory" class="text-white bg-azure-radiance-500 hover:bg-azure-radiance-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                        <button  type="button" id="closeBtn_2" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End of edit model --}}

    <script type="text/javascript">
        $(document).ready(function() {
            // Click delete button
            $('.remove').click(function() {
                // Get entry id after click delete button
                var id = $(this).attr('id');

                // Open confirm dialog
                $('#confirmDialog').show();

                // Path
                var url = 'delete/'+id;

                // Ajax action
                $('#confirm').click(function() {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: 'user_id='+id,
                        success: function(data){
                            alert("Records delete successfully. Record ID:"+id);
                            location.reload();
                        },
                        error: function(data){
                            alert("Recods not delete. Try again");
                            location.reload();
                        }
                    });
                });

                // Close model
                $('#cancel').click(function() {
                    $('#confirmDialog').hide();
                });

            });
        });
    </script>
    <script src="{{ asset('js/edit-user.js') }}" type="text/javascript"></script>
@endsection
