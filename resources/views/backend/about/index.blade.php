@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                about

            </div>
            <div class="card-body">
                <form action="{{route("backend.about.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $about->title }}" placeholder="Enter the post title">
                       @error('title')
                       <p class="text-danger">{{ $message }}</p>

                       @enderror
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Sub Title</label>
                        <input type="text" name="sub_title" class="form-control" value="{{ $about->sub_title }}" placeholder="Enter the post sub title">
                        @error('sub_title')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control my-editor" cols="30" rows="10">{{ $about->description }}</textarea>
                        {{-- @error('description')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror --}}


                    </div>
                    <button class="btn btn-success" class="btn btn-success">Save</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
