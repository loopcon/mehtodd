<!-- mobile menu end  -->
@extends('frontend.partial.master')
@section('content')
    <div class="be-apart-bg">
        <div class="container">
            <div>
                <h4>{{ __('messages.contact_us') }} <i class="fa-solid fa-arrow-turn-down"></i></h4>
            </div>
        </div>
    </div>

    <!-- get  in touch  start  -->
    {{-- <div class="contact-usboxmain">
        <div class="container">
            <div class="get-in-touchsection">
                <div class="grid-get-in-touch row">
                    <div class="col-12 col-sm-6">
                        <h2 class="get-in-touchtext">GET IN TOUCH</h2>
                        <div>
                            <form>
                                <div class="name-input">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" placeholder="Ex.Ralph Davies">
                                </div>
                                <div class="name-input">
                                    <label for="name">Email</label>
                                    <input class="form-control" type="email" placeholder="Ex.ralphdavies@gmail.com">
                                </div>
                                <div class="name-input">
                                    <label for="name">Message</label>
                                    <textarea class="form-control" rows="2" placeholder="Mention additional details about your needs?"></textarea>
                                </div>
                                <button class="git-request-btn">Request Information</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <img src="img/gt-in-touch.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="contact-usboxmain">
        @include('frontend.partial.getintouch')
    </div>
@endsection
