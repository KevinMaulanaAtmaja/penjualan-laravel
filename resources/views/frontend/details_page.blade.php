@extends('frontend.dashboard.index')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @php
        $products = App\Models\Product::where('client_id', $client->id)->limit(3)->get();
        $menuNames = $products
            ->map(function ($product) {
                return $product->menu->menu_name;
            })
            ->toArray();
        $menuNamesString = implode(' . ', $menuNames);

        $coupons = App\Models\Coupon::where('client_id', $client->id)->where('status', '1')->first();
    @endphp

    <section class="restaurant-detailed-banner">
        <div class="text-center">
            <img class="img-fluid cover" src="{{ asset('upload/client_images/' . $client->cover_photo) }}">
        </div>
        <div class="restaurant-detailed-header">
            <div class="container">
                <div class="row d-flex align-items-end">
                    <div class="col-md-8">
                        <div class="restaurant-detailed-header-left">
                            <p class="mb-2 text-info"><i
                                    class="mr-2 font-bold font-size-24 icofont-phone-circle text-info"></i>
                                {{ $client->phone }}</p>
                            <h2 class="text-white">{{ $client->name }}</h2>
                            <p class="mb-1 text-white"><i class="icofont-location-pin"></i> {{ $client->address }}
                                <span class="badge badge-success">OPEN</span>
                            </p>
                            <p class="mb-0 text-white"><i class="icofont-food-cart"></i> {{ $menuNamesString }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-right restaurant-detailed-header-right">
                            <button class="btn btn-success" type="button"><i class="icofont-clock-time"></i> 25–35 min
                            </button>
                            <h6 class="mb-0 text-white restaurant-detailed-ratings"><span
                                    class="text-white rounded generator-bg"><i class="icofont-star"></i> 3.1</span> 23
                                Ratings <i class="ml-3 icofont-speech-comments"></i> 91 reviews</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="bg-white shadow-sm offer-dedicated-nav border-top-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="float-right restaurant-detailed-action-btn">
                        <button class="btn btn-light btn-sm border-light-btn" type="button"><i
                                class="icofont-heart text-danger"></i> Mark as Favourite</button>
                        <button class="btn btn-light btn-sm border-light-btn" type="button"><i
                                class="icofont-cauli-flower text-success"></i> Pure Veg</button>
                        <button class="btn btn-outline-danger btn-sm" type="button"><i class="icofont-sale-discount"></i>
                            OFFERS</button>
                    </span>
                    <ul class="nav" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill"
                                href="#pills-order-online" role="tab" aria-controls="pills-order-online"
                                aria-selected="true">Order Online</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery"
                                role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill"
                                href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info"
                                aria-selected="false">Restaurant Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-book-tab" data-toggle="pill" href="#pills-book" role="tab"
                                aria-controls="pills-book" aria-selected="false">Book A Table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews"
                                role="tab" aria-controls="pills-reviews" aria-selected="false">Ratings & Reviews</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-2 pb-2 mt-4 mb-4 offer-dedicated-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="offer-dedicated-body-left">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel"
                                aria-labelledby="pills-order-online-tab">
                                @php
                                    $populers = App\Models\Product::where('status', 1)
                                        ->where('client_id', $client->id)
                                        ->where('most_populer', 1)
                                        ->orderBy('id', 'desc')
                                        ->limit(5)
                                        ->get();
                                @endphp
                                <div id="#menu" class="p-4 mb-4 bg-white rounded shadow-sm explore-outlets">
                                    <h6 class="mb-3">Most Popular <span class="badge badge-success"><i
                                                class="icofont-tags"></i> 15% Off All Items </span></h6>
                                    <div class="mb-3 owl-carousel owl-theme owl-carousel-five offers-interested-carousel">

                                        @foreach ($populers as $populer)
                                            <div class="item">
                                                <div class="mall-category-item">
                                                    <a href="#">
                                                        <img class="img-fluid" src="{{ asset($populer->image) }}">
                                                        <h6>{{ $populer->name }}</h6>
                                                        @if ($populer->discount_price == null)
                                                            ${{ $populer->price }}
                                                        @else
                                                            $<del>{{ $populer->price }}</del>
                                                            ${{ $populer->discount_price }}
                                                        @endif
                                                        <span class="float-right">
                                                            <a class="btn btn-outline-secondary btn-sm"
                                                                href="{{ route('add_to_cart', $populer->id) }}">ADD</a>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @php
                                    $bestsellers = App\Models\Product::where('status', 1)
                                        ->where('client_id', $client->id)
                                        ->where('best_seller', 1)
                                        ->orderBy('id', 'desc')
                                        ->limit(3)
                                        ->get();
                                @endphp
                                <div class="row">
                                    <h5 class="mt-3 mb-4 col-md-12">Best Sellers</h5>
                                    @foreach ($bestsellers as $bestseller)
                                        <div class="mb-4 col-md-4 col-sm-6">
                                            <div
                                                class="overflow-hidden bg-white rounded shadow-sm list-card h-100 position-relative">
                                                <div class="list-card-image">
                                                    <div class="star position-absolute"><span
                                                            class="badge badge-success"><i class="icofont-star"></i> 3.1
                                                            (300+)
                                                        </span></div>
                                                    <div class="favourite-heart text-danger position-absolute"><a
                                                            href="#"><i class="icofont-heart"></i></a></div>
                                                    <div class="member-plan position-absolute"><span
                                                            class="badge badge-dark">Promoted</span></div>
                                                    <a href="#">
                                                        <img src="{{ asset($bestseller->image) }}"
                                                            class="img-fluid item-img">
                                                    </a>
                                                </div>
                                                <div class="p-3 position-relative">
                                                    <div class="list-card-body">
                                                        <h6 class="mb-1"><a href="#"
                                                                class="text-black">{{ $bestseller->name }}</a></h6>
                                                        <p class="mb-2 text-gray">{{ $bestseller['city']['city_name'] }}
                                                        </p>

                                                        <p class="mb-0 text-gray time">
                                                            @if ($bestseller->discount_price == null)
                                                                <a class="text-black btn btn-link btn-sm"
                                                                    href="#">${{ $bestseller->price }} </a>
                                                            @else
                                                                $<del>{{ $bestseller->price }}</del>
                                                                <a class="text-black btn btn-link btn-sm"
                                                                    href="#">${{ $bestseller->discount_price }} </a>
                                                            @endif
                                                            <span class="float-right">
                                                                <a class="btn btn-outline-secondary btn-sm"
                                                                    href="{{ route('add_to_cart', $bestseller->id) }}">ADD</a>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>



                                @foreach ($menus as $menu)
                                    <div class="row">
                                        <h5 class="mt-3 mb-4 col-md-12">{{ $menu->menu_name }} <small
                                                class="h6 text-black-50">{{ $menu->products->count() }} ITEMS</small></h5>
                                        <div class="col-md-12">
                                            <div class="mb-4 bg-white border rounded shadow-sm">
                                                @foreach ($menu->products as $product)
                                                    <div class="p-3 menu-list border-bottom">

                                                        <a class="float-right btn btn-outline-secondary btn-sm"
                                                            href="{{ route('add_to_cart', $product->id) }}">ADD</a>
                                                        <div class="media">
                                                            <img class="mr-3 rounded-pill"
                                                                src="{{ asset($product->image) }}"
                                                                alt="Generic placeholder image">
                                                            <div class="media-body">
                                                                <h6 class="mb-1">{{ $product->name }}</h6>
                                                                @if ($product->size == null)
                                                                    <p class="mb-0 text-gray"> </p>
                                                                @else
                                                                    <p class="mb-0 text-gray"> ({{ $product->size }} cm)
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="pills-gallery" role="tabpanel"
                                aria-labelledby="pills-gallery-tab">
                                <div id="gallery" class="p-4 mb-4 bg-white rounded shadow-sm">
                                    <div class="restaurant-slider-main position-relative homepage-great-deals-carousel">
                                        <div class="owl-carousel owl-theme homepage-ad">

                                            @foreach ($gallerys as $index => $gallery)
                                                <div class="item">
                                                    <img class="img-fluid" src="{{ asset($gallery->gallery_img) }}">
                                                    <div
                                                        class="text-white position-absolute restaurant-slider-pics bg-dark">
                                                        {{ $index + 1 }} of {{ $gallerys->count() }} Photos</div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel"
                                aria-labelledby="pills-restaurant-info-tab">
                                <div id="restaurant-info" class="p-4 mb-4 bg-white rounded shadow-sm">
                                    <div class="float-right ml-5 address-map">
                                        <div class="mapouter">
                                            <div class="gmap_canvas"><iframe width="300" height="170"
                                                    id="gmap_canvas"
                                                    src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=9&ie=UTF8&iwloc=&output=embed"
                                                    frameborder="0" scrolling="no" marginheight="0"
                                                    marginwidth="0"></iframe></div>
                                        </div>
                                    </div>
                                    <h5 class="mb-4">Restaurant Info</h5>
                                    <p class="mb-3">{{ $client->address }}

                                    </p>
                                    <p class="mb-2 text-black"><i class="mr-2 icofont-phone-circle text-primary"></i>
                                        {{ $client->phone }}</p>
                                    <p class="mb-2 text-black"><i class="mr-2 icofont-email text-primary"></i>
                                        {{ $client->email }}</p>
                                    <p class="mb-2 text-black"><i class="mr-2 icofont-clock-time text-primary"></i>
                                        {{ $client->shop_info }}
                                        <span class="badge badge-success"> OPEN NOW </span>
                                    </p>
                                    <hr class="clearfix">
                                    <p class="mb-0 text-black">You can also check the 3D view by using our menue map
                                        clicking here &nbsp;&nbsp;&nbsp; <a class="text-info font-weight-bold"
                                            href="#">Venue Map</a></p>
                                    <hr class="clearfix">
                                    <h5 class="mt-4 mb-4">More Info</h5>
                                    <p class="mb-3">Dal Makhani, Panneer Butter Masala, Kadhai Paneer, Raita, Veg Thali,
                                        Laccha Paratha, Butter Naan</p>
                                    <div class="mb-4 border-btn-main">
                                        <a class="mr-2 border-btn text-success" href="#"><i
                                                class="icofont-check-circled"></i> Breakfast</a>
                                        <a class="mr-2 border-btn text-danger" href="#"><i
                                                class="icofont-close-circled"></i> No Alcohol Available</a>
                                        <a class="mr-2 border-btn text-success" href="#"><i
                                                class="icofont-check-circled"></i> Vegetarian Only</a>
                                        <a class="mr-2 border-btn text-success" href="#"><i
                                                class="icofont-check-circled"></i> Indoor Seating</a>
                                        <a class="mr-2 border-btn text-success" href="#"><i
                                                class="icofont-check-circled"></i> Breakfast</a>
                                        <a class="mr-2 border-btn text-danger" href="#"><i
                                                class="icofont-close-circled"></i> No Alcohol Available</a>
                                        <a class="mr-2 border-btn text-success" href="#"><i
                                                class="icofont-check-circled"></i> Vegetarian Only</a>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="pills-book" role="tabpanel" aria-labelledby="pills-book-tab">
                                <div id="book-a-table"
                                    class="p-4 mb-5 bg-white rounded shadow-sm rating-review-select-page">
                                    <h5 class="mb-4">Book A Table</h5>
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Full Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Email address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Mobile number</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Mobile number">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Date And Time</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Date And Time">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right form-group">
                                            <button class="btn btn-primary" type="button"> Submit </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-reviews" role="tabpanel"
                                aria-labelledby="pills-reviews-tab">
                                <div id="ratings-and-reviews"
                                    class="clearfix p-4 mb-4 bg-white rounded shadow-sm restaurant-detailed-star-rating">
                                    <span class="float-right star-rating">
                                        <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                                        <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                                        <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                                        <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                                        <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                    </span>
                                    <h5 class="pt-1 mb-0">Rate this Place</h5>
                                </div>

                                <div class="clearfix p-4 mb-4 bg-white rounded shadow-sm graph-star-rating">
                                    <h5 class="mb-4">Ratings and Reviews</h5>
                                    <div class="graph-star-rating-header">
                                        <div class="star-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <a href="#"><i
                                                        class="icofont-ui-rating {{ $i <= round($roundedAverageRating) ? 'active' : '' }}"></i></a>
                                            @endfor
                                            <b class="ml-2 text-black">{{ $totalReviews }}</b>
                                        </div>
                                        <p class="mt-2 mb-4 text-black">Rated {{ $roundedAverageRating }} out of 5</p>
                                    </div>

                                    <div class="graph-star-rating-body">

                                        @foreach ($ratingCounts as $star => $count)
                                            <div class="rating-list">
                                                <div class="text-black rating-list-left">
                                                    {{ $star }} Star
                                                </div>
                                                <div class="rating-list-center">
                                                    <div class="progress">
                                                        <div style="width: {{ $ratingPercentages[$star] }}%"
                                                            aria-valuemax="5" aria-valuemin="0" aria-valuenow="5"
                                                            role="progressbar" class="progress-bar bg-primary">
                                                            <span class="sr-only">{{ $ratingPercentages[$star] }}%
                                                                Complete (danger)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-black rating-list-right">
                                                    {{ number_format($ratingPercentages[$star], 2) }}%</div>
                                            </div>
                                        @endforeach

                                    </div>


                                    <div class="mt-3 mb-3 text-center graph-star-rating-footer">
                                        <button type="button" class="btn btn-outline-primary btn-sm">Rate and
                                            Review</button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 mb-4 bg-white rounded shadow-sm restaurant-detailed-ratings-and-reviews">
                                <a href="#" class="float-right btn btn-outline-primary btn-sm">Top Rated</a>
                                <h5 class="mb-1">All Ratings and Reviews</h5>
                                <style>
                                    .icofont-ui-rating {
                                        color: #ccc;
                                    }

                                    .icofont-ui-rating.active {
                                        color: #dd646e;
                                    }
                                </style>

                                @php
                                    $reviews = App\Models\Review::where('client_id', $client->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->limit(5)
                                        ->get();

                                    // App\Models\Review::where('client_id',$client->id)->where('status',1)->latest()->limit(5)->get();

                                @endphp

                                @foreach ($reviews as $review)
                                    <div class="pt-4 pb-4 reviews-members">
                                        <div class="media">
                                            <a href="#"><img alt="Generic placeholder image"
                                                    src="{{ !empty($review->user->photo) ? url('upload/user_images/' . $review->user->photo) : url('upload/no_image.jpg') }}"
                                                    class="mr-3 rounded-pill"></a>
                                            <div class="media-body">
                                                <div class="reviews-members-header">
                                                    <span class="float-right star-rating">
                                                        @php
                                                            $rating = $review->rating ?? 0;
                                                        @endphp
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $rating)
                                                                <a href="#"><i
                                                                        class="icofont-ui-rating active"></i></a>
                                                            @else
                                                                <a href="#"><i class="icofont-ui-rating"></i></a>
                                                            @endif
                                                        @endfor
                                                    </span>
                                                    <h6 class="mb-1"><a class="text-black"
                                                            href="#">{{ $review->user->name }}</a></h6>
                                                    <p class="text-gray">
                                                        {{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="reviews-members-body">
                                                    <p> {{ $review->comment }} </p>
                                                </div>
                                                <div class="reviews-members-footer">
                                                    <a class="total-like" href="#"><i
                                                            class="icofont-thumbs-up"></i> 856M</a> <a class="total-like"
                                                        href="#"><i class="icofont-thumbs-down"></i> 158K</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <hr>

                                <hr>
                                <a class="mt-4 text-center w-100 d-block font-weight-bold" href="#">See All
                                    Reviews</a>
                            </div>
                            <div class="p-4 mb-5 bg-white rounded shadow-sm rating-review-select-page">
                                @guest
                                    <p><b>For Add Resturant Review. You need to login first <a href="{{ route('login') }}">
                                                Login Here </a> </b></p>
                                @else
                                    <style>
                                        .star-rating label {
                                            display: inline-flex;
                                            margin-right: 5px;
                                            cursor: pointer;
                                        }

                                        .star-rating input[type="radio"] {
                                            display: none;
                                        }

                                        .star-rating input[type="radio"]:checked+.star-icon {
                                            color: #dd646e;
                                        }
                                    </style>

                                    <h5 class="mb-4">Leave Comment</h5>
                                    <p class="mb-2">Rate the Place</p>
                                    <form method="post" action="{{ route('store.review') }}">
                                        @csrf
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                                        <div class="mb-4">
                                            <span class="star-rating">
                                                <label for="rating-1">
                                                    <input type="radio" name="rating" id="rating-1" value="1"
                                                        hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>

                                                <label for="rating-2">
                                                    <input type="radio" name="rating" id="rating-2" value="2"
                                                        hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>
                                                <label for="rating-3">
                                                    <input type="radio" name="rating" id="rating-3" value="3"
                                                        hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>

                                                <label for="rating-4">
                                                    <input type="radio" name="rating" id="rating-4" value="4"
                                                        hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>

                                                <label for="rating-5">
                                                    <input type="radio" name="rating" id="rating-5" value="5"
                                                        hidden><i class="icofont-ui-rating icofont-2x star-icon"></i></label>


                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label>Your Comment</label>
                                            <textarea class="form-control" name="comment" id="comment"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm" type="submit"> Submit Comment
                                            </button>
                                        </div>
                                    </form>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>


                @php
                    use Carbon\Carbon;
                    $coupon = App\Models\Coupon::where('client_id', $client->id)
                        ->where('validity', '>=', Carbon::now()->format('Y-m-d'))
                        ->latest()
                        ->first();
                @endphp
                <div class="col-md-4">
                    <div class="pb-2">
                        <div
                            class="clearfix p-4 mb-4 text-white bg-white rounded shadow-sm restaurant-detailed-earn-pts card-icon-overlap">
                            <img class="float-left mr-3 img-fluid" src="{{ asset('frontend/img/earn-score-icon.png') }}">
                            <h6 class="pt-0 mb-1 text-primary font-weight-bold">OFFER</h6>
                            {{-- <pre>{{ print_r(Session::get('coupon'), true) }}</pre> --}}
                            @if ($coupon == null)
                                <p class="mb-0">No Coupon is Available </p>
                            @else
                                <p class="mb-0">{{ $coupon->discount }}% off on orders above $99 | Use coupon <span
                                        class="text-danger font-weight-bold">{{ $coupon->coupon_name }}</span></p>
                            @endif
                            <div class="icon-overlap">
                                <i class="icofont-sale-discount"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 mb-4 rounded shadow-sm generator-bg osahan-cart-item">
                        <h5 class="mb-1 text-white">Your Order</h5>
                        <p class="mb-4 text-white">{{ count((array) session('cart')) }} ITEMS</p>
                        <div class="mb-2 bg-white rounded shadow-sm">

                            @php $total = 0 @endphp
                            @if (session('cart'))
                                <h5 class="ml-3">
                                    Subtotal :
                                </h5>
                                @foreach (session('cart') as $id => $details)
                                    @php
                                        $total += $details['price'] * $details['quantity'];
                                    @endphp

                                    <div class="p-2 gold-members border-bottom">
                                        <p class="float-right mb-0 ml-2 text-gray">
                                            ${{ $details['price'] * $details['quantity'] }}</p>
                                        <span class="float-right count-number">

                                            <button class="btn btn-outline-secondary btn-sm left dec"
                                                data-id="{{ $id }}"> <i class="icofont-minus"></i> </button>

                                            <input class="count-number-input" type="text"
                                                value="{{ $details['quantity'] }}" readonly="">

                                            <button class="btn btn-outline-secondary btn-sm right inc"
                                                data-id="{{ $id }}"> <i class="icofont-plus"></i> </button>

                                            <button class="btn btn-outline-danger btn-sm right remove"
                                                data-id="{{ $id }}"> <i class="icofont-trash"></i> </button>
                                        </span>
                                        <div class="media">
                                            <div class="mr-2"><img src="{{ asset($details['image']) }}"
                                                    width="25px">
                                            </div>
                                            <div class="media-body">
                                                <p class="mt-1 mb-0 text-black">{{ $details['name'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if (Session::has('coupon'))
                            <div class="clearfix p-2 mb-2 bg-white rounded">

                                <p class="mb-1">
                                    Item Total
                                    <span class="float-right text-dark">
                                        {{ count((array) session('cart')) }}
                                    </span>
                                </p>

                                <p class="mb-1">
                                    Coupon Name
                                    <span class="float-right text-dark">
                                        {{ session('coupon.coupon_name') }} ({{ session('coupon.discount') }}%)
                                    </span>
                                    <a type="submit" onclick="couponRemove()">
                                        <i class="float-right icofont-ui-delete" style="color:red;"></i>
                                    </a>
                                </p>

                                <p class="mb-1 text-success">
                                    Discount
                                    <span class="float-right text-success">
                                        ${{ session('coupon.discount_amount') }}
                                    </span>
                                </p>

                                <hr />

                                <h6 class="mb-0 font-weight-bold">
                                    TO PAY
                                    <span class="float-right">
                                        ${{ $total - session('coupon.discount_amount') }}
                                    </span>
                                </h6>

                            </div>
                        @else
                            <div class="clearfix p-2 mb-2 bg-white rounded">
                                <div class="mb-2 input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Enter promo code"
                                        id="coupon_name">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" onclick="ApplyCoupon()">
                                            <i class="icofont-sale-discount"></i> APPLY
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="clearfix p-2 mb-2 bg-white rounded">
                            <img class="float-left img-fluid" src="{{ asset('frontend/img/wallet-icon.png') }}">
                            <h6 class="mb-2 text-right font-weight-bold">Subtotal : <span class="text-danger">
                                    @if (Session::has('coupon'))
                                        ${{ $total - Session()->get('coupon')['discount_amount'] }}
                                    @else
                                        ${{ $total }}
                                    @endif
                                </span></h6>
                            <p class="mb-1 text-right seven-color">Extra charges may apply</p>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-success btn-block btn-lg">Checkout <i
                                class="icofont-long-arrow-right"></i></a>
                    </div>

                    <div class="pt-2 mb-4 text-center">
                    </div>
                    <div class="pt-2 text-center">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
            $('.inc').on('click', function() {
                var id = $(this).data('id');
                var input = $(this).closest('span').find('input');
                var newQuantity = parseInt(input.val()) + 1;
                updateQuantity(id, newQuantity);
            });

            $('.dec').on('click', function() {
                var id = $(this).data('id');
                var input = $(this).closest('span').find('input');
                var newQuantity = parseInt(input.val()) - 1;
                if (newQuantity >= 1) {
                    updateQuantity(id, newQuantity);
                }
            });

            $('.remove').on('click', function() {
                var id = $(this).data('id');
                removeFromCart(id);
            });

            function updateQuantity(id, quantity) {
                $.ajax({
                    url: '{{ route('cart.updateQuantity') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity
                    },
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Quantity Updated'
                        }).then(() => {
                            location.reload();
                        });
                    }
                })
            }

            function removeFromCart(id) {
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Cart Remove Successfully'
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            }

        })
    </script>
@endsection
