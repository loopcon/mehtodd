@extends('frontend.partial.master')

@section('page-css')
    <style>
        @media (max-width: 575px) {
            .be-apart-bg h4 {
                font-size: 26px;
            }

            .become-herodicus-coachbox h4 {
                font-size: 26px;
                line-height: 26px;
            }

            .our-clients-heading {
                font-size: 26px;
                line-height: 26px;
            }

            .join-free-text h4 {
                font-size: 26px;
                line-height: 26px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="be-apart-bg">
        <div class="container">
            <div>
                <p>Be a part of the fitness revolution</p>
                <h4>Become A Physio <i class="fa-solid fa-arrow-turn-down"></i></h4>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="become-herodicus-box">
            <div class="become-herodicus-img-box">
                <img src="{{ asset('frontend/img/become-physio-detail.png') }}" class="become-herodicus-img" alt="">
            </div>
            <div class="become-herodicus-coachbox">
                <h4>Become a Herodicus Coach</h4>
                <p>Herodicus Coaches have helped more than 300,000 people achieve their fitness goals and regularly guide
                    over 3 million community members looking to transform themselves.</p>
                <p>As a coach, you'll educate and support the Herodicus community while influencing and motivating members
                    to live their best lives. You will serve as a health ambassador who constantly strives to bring the
                    benefits of fitness and nutrition to people from around the globe.</p>
                <p>If you're ready to take your career in online fitness to the next level, consider becoming a FITTR Coach
                    today!
                    Become a fitness coach</p>
                <button type="button" class="btn btn-primary" id="become_coch" data-toggle="modal" data-target="#registerModal">
                    Become A Fitness Coach
                </button>
            </div>

            <div class="modal fade" id="siguploginModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog siguplogin-dailog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                            <!-- <button type="button" class="btn-close"  aria-label="Close"></button> -->
                        </div>

                        <div class="modal-body">
                            <div class="row m-0">
                                <div class="col-12 col-md-5 p-0">
                                    <img class="img-fluid login-img-popup"
                                        src="{{ asset('frontend/img/our-clients-img.png') }}" alt="">
                                </div>

                                <div class="col-12 col-md-7 p-0">
                                    <div class="login-register-form-box">
                                        <div class="login-register-box">
                                            <a href="#" class="login-text login-active">Login</a>
                                            <a href="#" class="register-text">Register</a>
                                        </div>

                                        <div>
                                            <form action="javascript:void(0);" class="login-form" id="loginForm">
                                                <div class="input-group mb-0">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fa-solid fa-user-plus"></i></span>
                                                    <input type="text" class="form-control" placeholder="EMAIL"
                                                        name="email" id="email" aria-label="email"
                                                        aria-describedby="basic-addon1" value="{{ session('email') }}">
                                                </div>
                                                <div style="margin-bottom: 20px">
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal login-data-input-error="email"></normal>
                                                    </span>
                                                </div>

                                                <div class="input-group mb-0">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fa-solid fa-key"></i></span>
                                                    <input type="password" class="form-control" placeholder="PASSWORD"
                                                        name="password" id="password" aria-label="Username"
                                                        aria-describedby="basic-addon1" value="{{ session('password') }}">
                                                </div>
                                                <div style="margin-bottom: 20px">
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal login-data-input-error="password"></normal>
                                                    </span>
                                                </div>

                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" name="remember"
                                                        id="remember" {{ session('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember"> Remember me</label>
                                                </div>

                                                <button class="login-form-signin" id="BtnSignin">SIGN IN</button>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="d-flex justify-content-end align-items-center"
                                                            style="margin-top: 20px">
                                                            <span>Forgot Password?</span> &nbsp; &nbsp;
                                                            <a href="#" class=" reset-password-link"
                                                                id="resetpassword">Reset</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <form action="javascript:void(0);" class="register-form" id="registerForm">
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="input-group mb-0">
                                                        <span class="input-group-text" id="basic-addon1"><i
                                                                class="fa-solid fa-user-tie"></i></span>
                                                        <select class="form-select" name="role_id" id="role_id"
                                                            aria-label="Username" placeholder="SELECT TYPE"
                                                            aria-describedby="basic-addon1">
                                                            <option value="" selected>SELECT PROFESSION </option>
                                                            <option value="2"> Profession User</option>
                                                            <option value="3"> Visitor User </option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <span class="input-error text-danger font-required"
                                                            role="alert">
                                                            <normal register-data-input-error="role_id"></normal>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 d-none" id="row_user_category_id">
                                                    <div class="input-group mb-0">
                                                        <span class="input-group-text" id="basic-addon1"><i
                                                                class="fa-solid fa-user-tie"></i></span>
                                                        <select class="form-select" name="user_category_id"
                                                            id="user_category_id" aria-label="Username"
                                                            placeholder="SELECT TYPE" aria-describedby="basic-addon1">
                                                            <option value="" selected>SELECT PROFESSION TYPE</option>
                                                            @php
                                                                $front_category_list = GetCategoryList();
                                                                // prx($front_category_list);
                                                            @endphp
                                                            @foreach ($front_category_list as $list)
                                                                <option value="{{ $list->id }}">{{ $list->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <span class="input-error text-danger font-required"
                                                            role="alert">
                                                            <normal register-data-input-error="user_category_id"></normal>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="input-group mb-0">
                                                            <span class="input-group-text" id="basic-addon1"><i
                                                                    class="fa-regular fa-user"></i></span>
                                                            <input type="text" class="form-control" name="fullname"
                                                                id="fullname" placeholder="Full Name"
                                                                aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
                                                        <div>
                                                            <span class="input-error text-danger font-required"
                                                                role="alert">
                                                                <normal register-data-input-error="fullname"></normal>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="input-group mb-0">
                                                            <span class="input-group-text" id="basic-addon1"><i
                                                                    class="fa-regular fa-user"></i></span>
                                                            <input type="text" class="form-control" name="displayname"
                                                                id="displayname" placeholder="Display Name"
                                                                aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>

                                                        <div style="margin-bottom: 20px">
                                                            <span class="input-error text-danger font-required"
                                                                role="alert">
                                                                <normal register-data-input-error="displayname"></normal>
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="input-group mb-0">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fa-solid fa-at"></i></span>
                                                    <input type="email" class="form-control" placeholder="EMAIL"
                                                        name="email" id="email" aria-label="Username"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                                <div style="margin-bottom: 20px">
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="email"></normal>
                                                    </span>
                                                </div>



                                                <div class="input-group mb-0">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fa-solid fa-key"></i></span>
                                                    <input type="password" class="form-control" placeholder="PASSWORD"
                                                        name="password" id="password" aria-label="Username"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                                <div style="margin-bottom: 20px">
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="password"></normal>
                                                    </span>
                                                </div>



                                                <div class="input-group mb-0">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fa-solid fa-key"></i></span>
                                                    <input type="password" class="form-control"
                                                        placeholder="CONFIRM PASSWORD" aria-label="Username"
                                                        name="password_confirmation" id="password_confirmation"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                                <div style="margin-bottom: 20px">
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="password_confirmation"></normal>
                                                    </span>
                                                </div>

                                                <div class="mb-1 form-check">
                                                    <input type="checkbox" name="newslatter" class="form-check-input"
                                                        id="exampleCheck1" checked>
                                                    <label class="form-check-label" for="exampleCheck1"> Subscribe to our
                                                        newsletter </label>
                                                </div>


                                                <div class="mb-0 form-check">
                                                    <input type="checkbox" class="form-check-input" id="privacy_policy"
                                                        name="privacy_policy">
                                                    <label class="form-check-label" for="exampleCheck1">I accept the Terms
                                                        of
                                                        Service and Privacy Policy</label>
                                                </div>
                                                <div style="margin-bottom: 20px">
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="privacy_policy"></normal>
                                                    </span>
                                                </div>


                                                <button type="submit" class="register-sign-up" id="btnSignUp">SIGN UP
                                                </button>
                                                <div class="alert alert-success mt-5" id="msg_sign_up"
                                                    style="display:none">
                                                    Registration successfully!
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                     <button type="button" class="btn btn-primary">Save changes</button>

                     </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row m-0">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 p-0">
            <div class="mastery-box">
                <img src="{{ asset('frontend/img/mastery-img.png') }}" class="img-fluid" alt="">
                <h4 class="mastery-texthead">Mastery</h4>
                <div class="mastery-box-hovershow">
                    <h4>Mastery</h4>
                    <p>"I’m so proud to be connected to BetterUp and its mission. I am proud to be part of this community.
                        More than ever I am dedicated to being an expert in what we do because. I am grateful to BetterUp
                        for the work they do to put Coaches out onto the “frontlines” in a way that is scalable and allows
                        us as a community to make a tectonic impact."</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 p-0">
            <div class="mastery-box">
                <img src="{{ asset('frontend/img/connection-img.png') }}" class="img-fluid" alt="">
                <h4 class="mastery-texthead">Connection</h4>
                <div class="mastery-box-hovershow">
                    <h4>Connection</h4>
                    <p>"I’m so proud to be connected to BetterUp and its mission. I am proud to be part of this community.
                        More than ever I am dedicated to being an expert in what we do because. I am grateful to BetterUp
                        for the work they do to put Coaches out onto the “frontlines” in a way that is scalable and allows
                        us as a community to make a tectonic impact."</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 p-0">
            <div class="mastery-box">
                <img src="{{ asset('frontend/img/community-img.png') }}" class="img-fluid" alt="">
                <h4 class="mastery-texthead">Community</h4>
                <div class="mastery-box-hovershow">
                    <h4>Community</h4>
                    <p>"I’m so proud to be connected to BetterUp and its mission. I am proud to be part of this community.
                        More than ever I am dedicated to being an expert in what we do because. I am grateful to BetterUp
                        for the work they do to put Coaches out onto the “frontlines” in a way that is scalable and allows
                        us as a community to make a tectonic impact."</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 p-0">
            <div class="mastery-box">
                <img src="{{ asset('frontend/img/purpose-img.png') }}" class="img-fluid" alt="">
                <h4 class="mastery-texthead">Purpose</h4>
                <div class="mastery-box-hovershow">
                    <h4>Purpose</h4>
                    <p>"I’m so proud to be connected to BetterUp and its mission. I am proud to be part of this community.
                        More than ever I am dedicated to being an expert in what we do because. I am grateful to BetterUp
                        for the work they do to put Coaches out onto the “frontlines” in a way that is scalable and allows
                        us as a community to make a tectonic impact."</p>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div id="our-clients" class="owl-carousel owl-theme">
            @foreach ($client as $key => $value)
                <div class="item">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <img src="{{ asset('uploads/images/' . $value->photo) }}">
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-2 our-client-item"></div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <h4 class="our-clients-heading">Our Clients</h4>
                            <div class="our-client-box">
                                <p> <i class="fa-solid fa-quote-left"></i> “{{ $value->description }}”</p>
                                <div>
                                    <span class="ourclient-doctor-name">{{ $value->name }}</span>
                                    <span class="clients-status-docter">{{ $value->degination }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- become Physio end  -->



    <!-- join today for free  start  -->

    <div class="join-free-bg">
        <img src="{{ asset('frontend/img/join-today-free.png') }}" class="img-fluid" alt="">
        <div class="join-free-text">
            <h4>Ready to become an Expert?
                Join today for free</h4>
            <button id="join_expert">Join As an Expert</button>
        </div>
    </div>

    <!-- join today for free  end  -->



    <!-- get  in touch  start  -->

    @include('frontend.partial.getintouch')
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#our-clients').owlCarousel({
                loop: true,
                margin: 30,
                dots: true,
                nav: true,
                items: 1,
                animateOut: 'slideOutUp',
                animateIn: 'slideInUp'
            });
        });
    </script>
 <script>
    $('#join_expert').on('click', function(e) {
        // alert('10');
        e.preventDefault();
            $('#siguploginModal').modal('show');
        });
</script>

<script>
    $('#become_coch').on('click', function(e) {
        // alert('10');
        e.preventDefault();
            $('#siguploginModal').modal('show');
        });
</script>

@endsection