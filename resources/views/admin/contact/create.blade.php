@extends('admin.admin_master')

@section('admin')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Create Contact</h2>
        </div>
        <div class="card-body">
          <form action="{{route('store.contact')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="email">Contact Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Contact" />
            </div>
            <div class="form-group">
              <label for="phone">Contact Phone</label>
              <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter Phone Contact"/>
            </div>
            <div class="form-group">
              <label for="address">Contact Adress</label>
              <textarea class="form-control" id="address" rows="3" name="address" placeholder="Enter Address Contact"></textarea>
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
