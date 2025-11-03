@extends('frontend.dashboard.index')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <section class="pt-4 pb-4 section osahan-account-page">
        <div class="container">
            <div class="row">

                @include('frontend.dashboard.sidebar')

                <div class="col-md-9">
                    <div class="p-4 bg-white rounded shadow-sm osahan-account-page-right h-100">
                        <div class="tab-pane">
                            <h4 class="mt-0 mb-4 font-weight-bold">Favourites</h4>
                            <div class="row">

                                @foreach ($wishlist as $wish)
                                    <div class="pb-2 mb-4 col-md-4 col-sm-6">
                                        <div
                                            class="overflow-hidden bg-white rounded shadow-sm list-card h-100 position-relative">
                                            <div class="list-card-image">
                                                <a href="{{ route('res.details', $wish->client_id) }}">
                                                    <img src="{{ asset('upload/client_images/' . $wish['client']['photo']) }}"
                                                        class="img-fluid item-img" style="width: 300px; height:200px;">
                                            </div>
                                            <div class="p-3 position-relative">
                                                <div class="list-card-body">
                                                    <h6 class="mb-1"><a
                                                            href="{{ route('res.details', $wish->client_id) }}"
                                                            class="text-black">{{ $wish['client']['name'] }}
                                                        </a>
                                                    </h6>
                                                    <div style="float:right; margin-bottom:5px">
                                                        <a href="{{ route('remove.wishlist', $wish->id) }}"
                                                            class="badge badge-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
