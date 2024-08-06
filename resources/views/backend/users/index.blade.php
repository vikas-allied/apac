@extends('backend.layouts.main')
@section('title','Users')
@section('content')

    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Users</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Users
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>

    <div class="app-content"> <!--begin::Container-->
        <!--change in that portion-->

        <div class="container-fluid"> <!--begin::Row-->

            <!--session message-->
            @if(session()->has('success'))
            @elseif(session()->has('error'))
            @endif
            <!--session message-->

            @role(config('globals.super_admin_role'))
            <div class="text-end my-3">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary" title="Add New User">Add New Users</a>
            </div>
            @endrole

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Roles</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->status == '1')
                                                <span class="badge rounded-pill bg-info text-dark">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-warning text-dark">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php

                                                $role = '';
                                                    if(!empty($user->getRoleNames())) {
                                                        foreach($user->getRoleNames() as $roleName) {
                                                            $role = $roleName;
                                                        }
                                                    }
                                            @endphp

                                            <span class="badge bg-primary">{{ deSlugify($role) }}</span>
                                            {{-- @endforeach
                                         @endif--}}
                                        </td>
                                        <td>
                                            @if($role != config('globals.super_admin_role'))
                                                @can('update_user')
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning" title="Edit User"><i class="bi bi-pencil-fill"></i></a>
                                                @endcan
                                                @can('delete_user')
                                                    <a href="#" class="btn btn-danger delete_data" id="{{ $user->id }}" title="Delete User"><i class="bi bi-trash-fill"></i></a>
                                                @endcan
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>   <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->

            </div> <!--end::Row-->

            <!--change in that portion-->
        </div>

    </div>

@endsection



@push('js')

    <script>

        $(document).ready(function() {

            // set sweet alert when success
            @if(session()->has('success'))

            toast('success', '{{ session()->get('success') }}');

            @elseif(session()->has('error'))

            toast('error', '{{ session()->get('error') }}');

            @endif
            // set sweet alert when success

            // delete with sweet alert
            $('.delete_data').click(function(event) {
                event.preventDefault(); // Prevent default link behavior

                var id = $(this).attr("id");

                Swal.fire({
                    title: 'Are you sure you want to delete this user?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.users.destroy', '') }}/" + id,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'User has been deleted successfully.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        // The user clicked "OK"
                                        window.location.reload();
                                    }
                                });

                                // Set a timeout to reload the page after 2 seconds
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the user.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>


@endpush
