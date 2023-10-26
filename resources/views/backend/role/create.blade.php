@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Create Role

            </div>
            <div class="card-body">
                <form action="{{route('Role.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter the post name">
                       @error('name')
                       <p class="text-danger">{{ $message }}</p>

                       @enderror
                    </div>


                    <button class="btn btn-success" class="btn btn-success">Save</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection


