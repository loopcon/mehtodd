@extends('frontend.partial.master')

@section('page-css')
    <style>
        .description{
            margin-left:10px;
            margin-right:10px;
            margin-top:15px;
        }
        
    </style>
@endsection


@section('content')
<div class="container">
    <div class="row mt-3 mb-3">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="description">
                {!! $page->description !!}
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>
@endsection

