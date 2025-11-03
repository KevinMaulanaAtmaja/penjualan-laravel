
    <nav class="shadow-sm navbar navbar-expand-lg navbar-light bg-light osahan-nav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}"><img alt="logo"
                    src="{{ asset('frontend/img/logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="ml-auto navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Restaurants
                        </a>
                    </li>
                    @php
                        $id = Auth::user()->id;
                        $profileData = App\Models\User::find($id);
                    @endphp

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img alt="Generic placeholder image"
                                src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                class="nav-osahan-pic rounded-pill"> My Account
                        </a>
                        <div class="border-0 shadow-sm dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="icofont-food-cart"></i>
                                Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user.logout') }}"><i
                                    class="icofont-sale-discount"></i> Logout </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-cart">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-basket"></i> Cart
                            <span class="badge badge-success">5</span>
                        </a>
                        <div class="p-0 border-0 shadow-sm dropdown-menu dropdown-cart-top dropdown-menu-right">
                            <div class="p-4 dropdown-cart-top-header">
                                <img class="mr-3 img-fluid" alt="osahan" src="{{ asset('frontend/img/cart.jpg') }}">
                                <h6 class="mb-0">Gus's World Famous Chicken</h6>
                                <p class="mb-0 text-secondary">310 S Front St, Memphis, USA</p>
                                <small><a class="text-primary font-weight-bold" href="#">View Full
                                        Menu</a></small>
                            </div>
                            <div class="p-4 dropdown-cart-top-body border-top">
                                <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka
                                    Sub 12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Corn & Peas
                                    Salad x 1 <span class="float-right text-secondary">$209</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Veg Seekh
                                    Sub 6" (15 cm) x 1 <span class="float-right text-secondary">$133</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka
                                    Sub 12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Corn & Peas
                                    Salad x 1 <span class="float-right text-secondary">$209</span></p>
                            </div>
                            <div class="p-4 dropdown-cart-top-footer border-top">
                                <p class="mb-0 font-weight-bold text-secondary">Sub Total <span
                                        class="float-right text-dark">$499</span></p>
                                <small class="text-info">Extra charges may apply</small>
                            </div>
                            <div class="p-2 dropdown-cart-top-footer border-top">
                                <a class="btn btn-success btn-block btn-lg" href="checkout.html"> Checkout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
