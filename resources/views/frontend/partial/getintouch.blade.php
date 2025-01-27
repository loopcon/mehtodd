<style>
    #btn_request_information {
        width: auto !important;
        padding: 0em 1.3em !important;
    }
</style>
<div class="container">
    <div class="get-in-touchsection">
        <div class="grid-get-in-touch row">
            <div class="col-12 col-md-6">
                <h2 class="get-in-touchtext">{{ __('messages.get_in_touch') }}</h2>
                <div>
                    <form action="javascript:void(0);" enctype="multipart/form-data" id="GetInTouchForm">

                        @csrf

                        <div class="name-input mb-0">
                            <label for="name">{{ __('messages.name') }}</label>
                            <input class="form-control" name="name" id="name" type="text"
                                placeholder="Ex.Ralph Davies">
                        </div>
                        <div style="margin-bottom: 30px">
                            <span class="input-error text-danger" role="alert">
                                <normal add-data-input-error="name"></normal>
                            </span>
                        </div>

                        <div class="name-input mb-0">
                            <label for="name">{{ __('messages.email') }}</label>
                            <input class="form-control " name="email" id="email" type="email"
                                placeholder="Ex.ralphdavies@gmail.com">
                        </div>
                        <div style="margin-bottom: 30px">
                            <span class="input-error text-danger" role="alert">
                                <normal add-data-input-error="email"></normal>
                            </span>
                        </div>


                        <div class="name-input mb-0">
                            <label for="name">{{ __('messages.message') }}</label>
                            <textarea class="form-control" name="message" id="message" rows="2"
                                placeholder="Mention additional details about your needs?"></textarea>
                        </div>
                        <div style="margin-bottom: 30px">
                            <span class="input-error text-danger" role="alert">
                                <normal add-data-input-error="message"></normal>
                            </span>
                        </div>

                        <button type="submit" class="git-request-btn"
                            id="btn_request_information">{{ __('messages.request_information') }}</button>

                        <div class="alert alert-success mt-5" id="msg_request_information" style="display:none">
                            {{ __('messages.details_sent_successfully') }}
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{ asset('frontend/img/gt-in-touch.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>
