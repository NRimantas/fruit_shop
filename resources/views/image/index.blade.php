@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Image Upload</h2>
            <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Select Image</label>
                    <input type="file" class="form-control" name="image">
                    {{-- error for image upload --}}
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
    @foreach ($images as $image )
        <img src="{{ asset($image->path) }}" alt="arbuzas">

    @endforeach
</div>


@endsection
