@extends('frontend.partial.master')

@section('content')
    <div class="container">
        <div class="get-in-touchsection chnage-password-box">
            <div class="grid-get-in-touch row">
                <div class="col-12 col-md-6">
                    <h2 class="get-in-touchtext">{{ __('messages.update_password') }}</h2>
                    <div>
                        <form action="{{ route('confirm.password') }}" enctype="multipart/form-data" id="changepassword"
                            method="POST">
                            @csrf
                            <div class="name-input mb-0">
                                <label for="currentpassword">{{ __('messages.current_password') }}</label>
                                <input class="form-control" name="currentpassword" id="currentpassword" type="password"
                                    placeholder="">

                            </div>
                            <div style="margin-bottom: 30px">
                                @error('currentpassword')
                                    <span class="input-error text-danger" role="alert">
                                        <normal>{{ $message }}</normal>
                                    </span>
                                @enderror
                            </div>


                            <div class="name-input mb-0">
                                <label for="password">{{ __('messages.new_password') }}</label>
                                <input class="form-control " name="password" id="password" type="password" placeholder="">
                            </div>

                            <div style="margin-bottom: 30px">
                                @error('password')
                                    <span class="input-error text-danger" role="alert">
                                        <normal>{{ $message }}</normal>
                                    </span>
                                @enderror
                            </div>


                            <div class="name-input mb-0">
                                <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
                                <input class="form-control " name="password_confirmation" id="password_confirmation" type="password"
                                    placeholder="">
                            </div>

                            <div style="margin-bottom: 30px">
                                @error('password_confirmation')
                                    <span class="input-error text-danger" role="alert">
                                        <normal>{{ $message }}</normal>
                                    </span>
                                @enderror
                            </div>


                            <button type="submit" class="git-request-btn">{{ __('messages.update_password') }}</button>

                            <div class="alert alert-success mt-5" id="msg_request_information" style="display:none">
                                {{ __('messages.password_updated_successfully') }}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
