@if (Route::currentRouteName() !== 'video-category.index')
    <div class="form-group">
        {!! Form::open([
            'route' => 'videos.index',
            'method' => 'get',
            'enctype' => 'multipart/form-data',
        ]) !!}
    @else
        <div class="form-group">
        {!! Form::open([
            'route' => 'video-category.index',
            'method' => 'get',
            'enctype' => 'multipart/form-data',
        ]) !!}
@endif
<div class="row mb-2">
    <div class="col-md-2 get_category_data " data-level="0">
        {!! Form::label('category_id', 'Category') !!}
        {{-- <span class="required">*</span> --}}
        <select class="form-select " name="category_id">
            <option value="">-- Select --</option>
            @foreach ($category_list as $list)
                @if ($list->category_id == null)
                    <option value="{{ $list->id }}" {{ $category_id == $list->id ? 'selected' : '' }}>
                        {{ $list->name }}</option>
                @endif
            @endforeach
        </select>
        {!! $errors->first('category_id', '<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-md-2 get_category_data" id="sub_category_1" data-level="1">
        {!! Form::label('sub_category_1', 'Sub Category 1') !!}
        {{-- <span class="required">*</span> --}}
        <select class="form-select " name="sub_category_1" id="select_sub_category_1">
            <option value="">-- Select --</option>
            @foreach ($sub_category_1_list as $list)
                <option value="{{ $list->id }}" {{ $sub_category_1 == $list->id ? 'selected' : '' }}>
                    {{ $list->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('sub_category_1', '<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-md-2 get_category_data" id="sub_category_2" data-level="2">
        {!! Form::label('sub_category_2', 'Sub Category 2') !!}
        {{-- <span class="required">*</span> --}}
        <select class="form-select " name="sub_category_2" id="select_sub_category_2">
            <option value="">-- Select --</option>
            @foreach ($sub_category_2_list as $list)
                <option value="{{ $list->id }}" {{ $sub_category_2 == $list->id ? 'selected' : '' }}>
                    {{ $list->category_name }}</option>
            @endforeach
        </select>
        {!! $errors->first('sub category_2', '<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-md-2 get_category_data" id="sub_category_3" data-level="3">
        {!! Form::label('sub_category_3', 'Sub Category 3') !!}
        {{-- <span class="required">*</span> --}}
        <select class="form-select " name="sub_category_3" id="select_sub_category_3">
            <option value="">-- Select --</option>
            @foreach ($sub_category_3_list as $list)
                <option value="{{ $list->id }}" {{ $sub_category_3 == $list->id ? 'selected' : '' }}>
                    {{ $list->category_name }}</option>
            @endforeach
        </select>
        {!! $errors->first('sub_category_3', '<span class="text-danger">:message</span>') !!}
    </div>

    @if (Route::currentRouteName() !== 'video-category.index')
        <div class="col-md-2 get_category_data" id="sub_category_4" data-level="4">
            {!! Form::label('sub_category_4', 'Sub Category 4') !!}
            {{-- <span class="required">*</span> --}}
            <select class="form-select " name="sub_category_4" id="select_sub_category_4">
                <option value="">-- Select --</option>
                @foreach ($sub_category_4_list as $list)
                    <option value="{{ $list->id }}" {{ $sub_category_4 == $list->id ? 'selected' : '' }}>
                        {{ $list->category_name }}</option>
                @endforeach
            </select>
            {!! $errors->first('sub_category_4', '<span class="text-danger">:message</span>') !!}
        </div>
    @endif

    <div class="col-md-2 mt-3">
        {!! Form::submit('Filter', ['class' => 'btn btn-outline-secondary btn-wave']) !!}
        {{-- @if (!empty(request()->input('category_id'))) --}}
        @if (Route::currentRouteName() == 'video-category.index')
            <a href="{{ route('video-category.index') }}" class="clear-link ml">Clear</a>
        @else
            <a href="{{ route('videos.index') }}" class="clear-link ml">Clear</a>
        @endif

    </div>
    {!! Form::close() !!}
</div>
</div>
