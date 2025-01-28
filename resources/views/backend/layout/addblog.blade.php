@extends('backend.app')

@section('Content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header p-3">
                <h3 class="d-inline">Add New Blog</h3>
                <!-- Back Button -->
                <a href="{{ route('admin') }}" class="btn btn-secondary btn-sm float-end">Back to List</a>
            </div>
            <div class="card-body">
                <!-- Add Blog Form -->
                <form action="{{ route('blogStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Blog Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" value="{{ old('title') }}"
                            name="title">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Blog Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label summernote">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Blog Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Add Blog</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // If you're using a WYSIWYG editor like Summernote, you can initialize it here
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null // set maximum height of editor
            });
        });
    </script>
@endsection
