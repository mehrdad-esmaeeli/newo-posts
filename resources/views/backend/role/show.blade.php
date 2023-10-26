@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Create Role

            </div>
            <div class="card-body">
                <form action="{{route('Role.update',['Role'=>$role_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @foreach ($permissions as $permission)
                    {{ $permission->name }}
                    <input type="checkbox" class="checkbox" name="permission[]" value="{{ $permission->id }}"><br>

                    @endforeach
                    <br>


                    <button class="btn btn-success" class="btn btn-success">Save</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection



