{!! Form::label('category', $label) !!}
{{-- <span class="required">*</span> --}}

{!! Form::select($name, ['' => '--Select--'] + $categories, null, [
    'class' => 'form-select w-100',
]) !!}
