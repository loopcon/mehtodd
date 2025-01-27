@extends('partial.master')
@section('page-css')
    <style>
        .required {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between mt-2 page-header-breadcrumb">
            <div class="col-10 ms-0">
                @include('error_message')
            </div>
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Update Setting
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open([
                        'route' => ['setting.update', 'setting' => $setting->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',

                    ]) !!}

                    @csrf
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('site_name', 'Site Name') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('site_name', $setting->site_name, [
                                    'placeholder' => 'Enter Site Name',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('site_name', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('phone', 'Phone') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('phone', $setting->phone, ['placeholder' => 'Enter PhoneNumber', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('address', 'Address') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::textarea('address', $setting->address, ['placeholder' => 'Enter Address', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('aboutus', 'About Us') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::textarea('aboutus', $setting->aboutus, ['placeholder' => 'Enter Aboutus', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('aboutus', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('contact_email', 'Contact Email') !!}
                                <span class="required">*</span>
                            </div>

                            <div class="col-md-6">
                                {!! Form::text('contact_email', $setting->contact_email, [
                                    'placeholder' => 'Enter Contact Email',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('contact_email', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('youtube', 'Youtube') !!}
                                {{-- <span class="required">*</span> --}}
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('youtube', $setting->youtube, ['placeholder' => 'Enter Youtube', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('youtube', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('fb', 'FaceBook') !!}
                                {{-- <span class="required">*</span> --}}
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('fb', $setting->fb, ['placeholder' => 'Enter FB', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('FB', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('insta  ', 'InstaGram') !!}
                                {{-- <span class="required">*</span> --}}
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('insta', $setting->insta, ['placeholder' => 'Enter Insta', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('insta', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                  

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('twitter  ', 'TwitterLink') !!}
                                {{-- <span class="required">*</span> --}}
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('twitter', $setting->twitter, ['placeholder' => 'Enter Twitter', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('twitter', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('copyright_year', 'Copyright Year') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('copyright_year', $setting->copyright_year, [
                                    'placeholder' => 'Copyright Year',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('copyright_year', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('password', 'Password') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('password', $setting->password, [
                                    'placeholder' => 'Enter Password',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('adminemail', 'Admin Email') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('adminemail', $setting->adminemail, [
                                    'placeholder' => 'Enter AdminEmail',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('adminemail', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('logo', 'Logo') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('logo', ['class' => 'form-control mb-2', 'id' => 'logoInput']) !!}
                                {!! $errors->first('logo', '<span class="text-danger">:message</span>') !!}
                            </div>
                            @if ($setting->logo != null)
                                <div class="col-md-2 text-left">
                                    <div class="image">
                                        <img src="{{ asset('uploads/logo/' . $setting->logo) }}" class="rounded elevation-2 img_logo_1" alt="Image"
                                            style="max-width: 80%;">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('fevicon', 'Fevicon') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::file('fevicon', ['placeholder' => 'Enter Fevicon', 'class' => 'form-control mb-2','id'=>'fevicon']) !!}
                                    {!! $errors->first('fevicon', '<span class="text-danger">:message</span>') !!}
                                </div>
                                @if ($setting->fevicon != null)
                                <div class="col-md-2 text-left">
                                    <div class="image">
                                        <img src="{{ asset('uploads/fevicon/' . $setting->fevicon) }}" class="rounded elevation-2 img_fevicon_1" alt="Image"
                                            style="max-width: 80%;">
                                    </div>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('seo_title', 'Seo Title') !!}
                                    <span class="required">*</span>
                                </div>

                                <div class="col-md-6">
                                    {!! Form::text('seo_title', $setting->seo_title, [
                                        'placeholder' => 'Enter SeoTitle',
                                        'class' => 'form-control mb-2',
                                    ]) !!}
                                    {!! $errors->first('seo_title', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('meta_keyword', 'Meta Keyword') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::text('meta_keyword', $setting->meta_keyword, [
                                        'placeholder' => 'Enter MetaKeyword',
                                        'class' => 'form-control mb-2',
                                    ]) !!}
                                    {!! $errors->first('meta_keyword', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('meta_description', 'Meta Description') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::textarea('meta_description', $setting->meta_description, [
                                        'placeholder' => 'Enter MetaDescription',
                                        'class' => 'form-control mb-2',
                                    ]) !!}
                                    {!! $errors->first('meta_description', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('canonical', 'Canonical') !!}
                                    <span class="required">*</span>
                                </div>

                                <div class="col-md-6">
                                    {!! Form::textarea('canonical', $setting->canonical, [
                                        'placeholder' => 'Enter Canonical',
                                        'class' => 'form-control mb-2',
                                    ]) !!}
                                    {!! $errors->first('canonical', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('googletagmanager', 'Google Tag Manager') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::textarea('googletagmanager', $setting->googletagmanager, [
                                        'placeholder' => 'Enter GoogleTagManager',
                                        'class' => 'form-control mb-2',
                                    ]) !!}
                                    {!! $errors->first('googletagmanager', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="row mt-4">
                                <div class="col-md-2 offset-md-3 mx-auto my-auto">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        {!! Form::submit('Update Setting', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            $(document).ready(function() {
                $('#logoInput').on('change', function(e) {
                    var fileInput = e.target;
                    var imgElement = $('.img_logo_1');
                    if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            imgElement.attr('src', e.target.result);
                            imgElement.show(); // Display the image
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                });

            });

        </script>

<script>
    $(document).ready(function() {
        $('#fevicon').on('change', function(e) {
            var fileInput = e.target;
            var imgElement = $('.img_fevicon_1');
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgElement.attr('src', e.target.result);
                    imgElement.show(); // Display the image
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        });

    });

</script>

    @endsection

