@extends('admin.admin_master')

@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>create slider</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('store.about') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">About Titel</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter title">
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Short description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="short_dis"></textarea>
                    </div>
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Long description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="log_dis"></textarea>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
