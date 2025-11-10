@extends('frontend.dashboard.index')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <section class="pt-5 pb-5 text-center breadcrumb-osahan bg-dark position-relative">
        <h1 class="text-white">Offers Near You</h1>
        <h6 class="text-white-50">Best deals at your favourite restaurants</h6>
    </section>
    <section class="pt-5 pb-5 section products-listing">
        <div class="container">
            <div class="row d-none-m">
                <div class="col-md-12">
                    <div class="float-right dropdown">
                        <a class="btn btn-outline-info dropdown-toggle btn-sm border-white-btn" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort by: <span class="text-theme">Distance</span> &nbsp;&nbsp;
                        </a>
                        <div class="border-0 shadow-sm dropdown-menu dropdown-menu-right ">
                            <a class="dropdown-item" href="#">Distance</a>
                            <a class="dropdown-item" href="#">No Of Offers</a>
                            <a class="dropdown-item" href="#">Rating</a>
                        </div>
                    </div>
                    <h4 class="mt-0 mb-3 font-weight-bold">OFFERS <small class="mb-0 ml-2 h6">299 restaurants
                        </small>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-4 bg-white rounded shadow-sm filters">
                        <div class="pt-3 pb-3 pl-4 pr-4 filters-header border-bottom">
                            <h5 class="m-0">Filter By</h5>
                        </div>
                        @php
                            $categories = App\Models\Category::orderBy('id', 'desc')->limit(10)->get();
                        @endphp
                        <div class="filters-body">
                            <div id="accordion">
                                <div class="p-4 filters-card border-bottom">
                                    <div class="filters-card-header" id="headingOne">
                                        <h6 class="mb-0">
                                            <a href="#" class="btn-link" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Category <i class="float-right icofont-arrow-down"></i>
                                            </a>
                                        </h6>
                                    </div>


                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="filters-card-body card-shop-filters">
                                            @foreach ($categories as $category)
                                                @php
                                                    $categoryProductCount = $products
                                                        ->where('category_id', $category->id)
                                                        ->count();
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input filter-checkbox"
                                                        id="category-{{ $category->id }}" data-type="category"
                                                        data-id="{{ $category->id }}">
                                                    <label class="custom-control-label"
                                                        for="category-{{ $category->id }}">{{ $category->category_name }}
                                                        <small class="text-black-50">({{ $categoryProductCount }})</small>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $cities = App\Models\City::orderBy('id', 'desc')->limit(10)->get();
                        @endphp
                        <div class="filters-body">
                            <div id="accordion">
                                <div class="p-4 filters-card border-bottom">
                                    <div class="filters-card-header" id="headingOnecity">
                                        <h6 class="mb-0">
                                            <a href="#" class="btn-link" data-toggle="collapse"
                                                data-target="#collapseOnecity" aria-expanded="true"
                                                aria-controls="collapseOnecity">
                                                City <i class="float-right icofont-arrow-down"></i>
                                            </a>
                                        </h6>
                                    </div>


                                    <div id="collapseOnecity" class="collapse show" aria-labelledby="headingOnecity"
                                        data-parent="#accordion">
                                        <div class="filters-card-body card-shop-filters">
                                            @foreach ($cities as $city)
                                                @php
                                                    $cityProductCount = $products->where('city_id', $city->id)->count();
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input filter-checkbox"
                                                        id="city-{{ $city->id }}" data-type="city"
                                                        data-id="{{ $city->id }}">
                                                    <label class="custom-control-label"
                                                        for="city-{{ $city->id }}">{{ $city->city_name }} <small
                                                            class="text-black-50">({{ $cityProductCount }})</small>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @php
                            $menus = App\Models\Menu::orderBy('id', 'desc')->limit(10)->get();
                        @endphp
                        <div class="filters-body">
                            <div id="accordion">
                                <div class="p-4 filters-card border-bottom">
                                    <div class="filters-card-header" id="headingOnemenu">
                                        <h6 class="mb-0">
                                            <a href="#" class="btn-link" data-toggle="collapse"
                                                data-target="#collapseOnemenu" aria-expanded="true"
                                                aria-controls="collapseOnemenu">
                                                Menu <i class="float-right icofont-arrow-down"></i>
                                            </a>
                                        </h6>
                                    </div>


                                    <div id="collapseOnemenu" class="collapse show" aria-labelledby="headingOnemenu"
                                        data-parent="#accordion">
                                        <div class="filters-card-body card-shop-filters">
                                            @foreach ($menus as $menu)
                                                @php
                                                    $menuProductCount = $products->where('menu_id', $menu->id)->count();
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input filter-checkbox"
                                                            id="menu-{{ $menu->id }}" data-type="menu"
                                                            data-id="{{ $menu->id }}">

                                                        <label class="custom-control-label"
                                                            for="menu-{{ $menu->id }}">
                                                            {{ $menu->menu_name }}
                                                            <small class="text-black-50">({{ $menuProductCount }})</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">

                    <div class="row" id="product-list">
                        @foreach ($products as $product)
                            <div class="pb-2 mb-4 col-md-4 col-sm-6">
                                <div class="overflow-hidden bg-white rounded shadow-sm list-card h-100 position-relative">
                                    <div class="list-card-image">
                                        <div class="star position-absolute"><span class="badge badge-success"><i
                                                    class="icofont-star"></i> 3.1 (300+)</span></div>
                                        <div class="favourite-heart text-danger position-absolute"><a
                                                href="{{ route('res.details', $product->client_id) }}"><i
                                                    class="icofont-heart"></i></a></div>
                                        <div class="member-plan position-absolute"><span
                                                class="badge badge-dark">Promoted</span></div>
                                        <a href="{{ route('res.details', $product->client_id) }}">
                                            <img src="{{ asset($product->image) }}" class="img-fluid item-img">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="{{ route('res.details', $product->client_id) }}"
                                                    class="text-black"> {{ $product->name }}</a></h6>

                                            <p class="mb-3 text-gray time"><span
                                                    class="pt-1 pb-1 pl-2 pr-2 rounded-sm bg-light text-dark"><i
                                                        class="icofont-wall-clock"></i> 20-25 min</span> <span
                                                    class="float-right text-black-50"> {{ $product->price }}</span></p>
                                        </div>
                                        <div class="list-card-badge">
                                            <span class="badge badge-success">OFFER</span> <small>65% off | Use Coupon
                                                OSAHAN50</small>
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
    </section>

    <script>
        $(document).ready(function() {
            $('.filter-checkbox').on('change', function() {
                var filters = {
                    categories: [],
                    cities: [],
                    menus: []
                };
                console.log(filters);
                $('.filter-checkbox:checked').each(function() {
                    var type = $(this).data('type');
                    var id = $(this).data('id');

                    if (!filters[type + 's']) {
                        filters[type + 's'] = [];
                    }
                    filters[type + 's'].push(id);
                });

                $.ajax({
                    url: '{{ route('filter.products') }}',
                    method: 'GET',
                    data: filters,
                    success: function(response) {
                        $('#product-list').html(response)
                    }
                });

            });
        })
    </script>
@endsection
