@extends('admin.layouts.index')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Role In Permission</h4>

                        <div class="page-title-right">
                            <ol class="m-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Role In Permission </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="p-4 card-body">

                            <form id="myForm" action="{{ route('role.permission.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>

                                            <div class="mb-3 form-group">
                                                <label for="example-text-input" class="form-label">Roles Name </label>
                                                <select name="role_id" class="form-select">
                                                    <option selected disabled>Select Roles</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 form-check">
                                                <input class="form-check-input" type="checkbox" id="formCheck1">
                                                <label class="form-check-label" for="formCheck1">
                                                    Permission All
                                                </label>
                                            </div>
                                            <hr>
                                            @foreach ($permission_groups as $group)
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="mb-3 form-check">
                                                            {{-- <input class="form-check-input group-checkbox" type="checkbox"
                                                                id="{{ $group->group_name }}"> --}}
                                                            <input class="form-check-input group-checkbox" type="checkbox"
                                                                data-group="{{ $group->group_name }}"
                                                                id="{{ $group->group_name }}">
                                                            <label class="form-check-label" for="{{ $group->group_name }}">
                                                                {{ $group->group_name }}
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-9">
                                                        @php
                                                            $permissions = App\Models\Admin::getpermissionByGroupName(
                                                                $group->group_name,
                                                            );
                                                        @endphp

                                                        @foreach ($permissions as $permission)
                                                            <div class="mb-3 form-check">
                                                                {{-- <input class="form-check-input" name="permission[]"
                                                                    value="{{ $permission->id }}" type="checkbox"
                                                                    id="flexCheckDefault{{ $permission->id }}"> --}}
                                                                <input class="form-check-input permission-checkbox"
                                                                    name="permission[]" value="{{ $permission->id }}"
                                                                    type="checkbox" data-group="{{ $group->group_name }}"
                                                                    id="flexCheckDefault{{ $permission->id }}">
                                                                <label class="form-check-label"
                                                                    for="flexCheckDefault{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        <br>
                                                    </div>

                                                </div>
                                            @endforeach

                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                                    Changes</button>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end tab content -->
                </div>
                <!-- end col -->


                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

    <script>
        $('#formCheck1').click(function() {
            if ($(this).is(':checked')) {
                $('input[ type=checkbox]').prop('checked', true)
            } else {
                $('input[ type=checkbox]').prop('checked', false)
            }
        })
    </script>
    <script>
        $('.group-checkbox').on('change', function() {
            const group = $(this).data('group');
            $('.permission-checkbox[data-group="' + group + '"]')
                .prop('checked', this.checked);
        });
    </script>
@endsection
