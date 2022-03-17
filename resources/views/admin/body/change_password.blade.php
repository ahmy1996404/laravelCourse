 @extends('admin.admin_master')

@section('admin')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>change</h2>
    </div>
    <div class="card-body">
        <form class="form-pill">
            <div class="form-group">
                <label for="exampleFormControlInput3">Current password</label>
                <input type="password" class="form-control" id="exampleFormControlInput3" placeholder="current password">
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword3">new Password</label>
                <input type="password" class="form-control" id="exampleFormControlPassword3" placeholder="new Password">
            </div>
              <div class="form-group">
                <label for="exampleFormControlPassword3">confirmPassword</label>
                <input type="password" class="form-control" id="exampleFormControlPassword3" placeholder="confirm Password">
            </div>
            <button type="submit" class="btn btn-primary btn-default">save</button>
        </form>
    </div>
</div>
@endsection
