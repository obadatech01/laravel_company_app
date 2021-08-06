@extends('admin.admin_master')

@section('admin')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Create Home About</h2>
        </div>
        <div class="card-body">
          <form action="{{route('store.about')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="title">About Title</label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Enter Slider Title" />
            </div>
            <div class="form-group">
              <label for="short_dis">Short Description</label>
              <textarea class="form-control" id="short_dis" rows="3" name="short_dis"></textarea>
            </div>
            <div class="form-group">
              <label for="long_dis">Long Description</label>
              <textarea class="form-control" id="long_dis" rows="3" name="long_dis"></textarea>
            </div>
            <div class="form-footer pt-5 mt-4 border-top">
              <button type="submit" class="btn btn-primary btn-default">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
