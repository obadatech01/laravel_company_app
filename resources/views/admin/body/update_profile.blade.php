@extends('admin.admin_master')

@section('admin')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>User Profile Update</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card-body">
        <form action="{{route('update.user.profile')}}" method="POST" class="form-pill">
            @csrf
            <div class="form-group">
                <label for="email">User Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$user['name']}}">
            </div>
            <div class="form-group">
                <label for="email">User Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{$user['email']}}">
            </div>
            <button type="submit" class="btn btn-primary btn-default">Save</button>
        </form>
    </div>
</div>
@endsection
