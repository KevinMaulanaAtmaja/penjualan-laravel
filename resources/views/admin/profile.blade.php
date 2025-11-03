@extends('admin.layouts.index')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Profile</h4>

                        <div class="page-title-right">
                            <ol class="m-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="order-2 col-sm order-sm-1">
                                    <div class="mt-3 d-flex align-items-start mt-sm-0">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xl me-3">
                                                <img src="{{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                                    alt="" class="img-fluid rounded-circle d-block">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="mb-1 font-size-16">{{ $profileData->name }}</h5>
                                                <p class="text-muted font-size-13">{{ $profileData->email }}</p>
                                                <p class="text-muted font-size-13">{{ $profileData->phone }}</p>
                                                <p class="text-muted font-size-13">{{ $profileData->address }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="p-4 card-body">
                        <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ $profileData->name }}" id="name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input class="form-control" type="email" name="email"
                                                value="{{ $profileData->email }}" id="email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input class="form-control" type="tel" name="phone"
                                                value="{{ $profileData->phone }}" id="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input class="form-control" type="text" name="address"
                                                value="{{ $profileData->address }}" id="address">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Profile Image</label>
                                            <input class="form-control" type="file" name="photo"
                                                value="{{ $profileData->photo }}" id="image">
                                        </div>
                                        <div class="mb-3">
                                            <img src="{{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                                alt="" class="p-1 rounded-circle bg-primary" width="110"
                                                id="showImage">
                                        </div>
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
                <!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
