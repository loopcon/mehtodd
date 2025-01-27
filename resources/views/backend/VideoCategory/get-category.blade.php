<option value="">Select Category</option>
@foreach ($categories as $id => $name)
    <option value="{{ $id }}">{{ $name }}</option>
@endforeach
