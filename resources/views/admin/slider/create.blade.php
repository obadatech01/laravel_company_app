@extends('admin.admin_master')

@section('admin')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Create Slider</h2>
        </div>
        <div class="card-body">
          <form action="{{route('store.slider')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="title">Slider Title</label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Enter Slider Title" />
            </div>
            <div class="form-group">
              <label for="description">Slider Description</label>
              <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
              <label for="image">Slider Image</label>
              <input type="file" name="image" class="form-control-file" id="image" />
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
