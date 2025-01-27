<div class="form-group mt-4">
    <div class="row">
        <div class="col-md-3">
            {!! Form::label('name', 'Name') !!}
            <span class="required">*</span>
        </div>
        <div class="col-md-6">
            {!! Form::text('name', null, ['placeholder' => 'Enter Name', 'class' => 'form-control mb-2']) !!}
            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
