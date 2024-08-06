@extends('backend.layouts.main')
@section('title', 'Roles')
@section('content')

    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Roles</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Roles
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

            <div class="text-end my-3">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary" title="Add New Role">Add New Role</a>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-bordered dataTable">
                                <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ deSlugify($role->name) }}</td>
                                        @if($role->name != config('globals.super_admin_role'))
                                            <td>

                                                <a href="{{ route('admin.roles.add_permission', $role->id) }}" class="btn btn-info" title="Add Permission to Role">
                                                    <i class="bi bi-gear"></i>
                                                </a>

                                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning" title="Edit Role">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger delete_data" id="{{ $role->id }}" title="Delete Role">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>

                                            </td>
                                        @else
                                            <td>  </td>
                                        @endif

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
                    title: 'Are you sure you want to delete this role?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.roles.destroy', '') }}/" + id,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Role has been deleted successfully.',
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
                                    'An error occurred while deleting the role.',
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
