 @extends('admin.admin_master')

@section('admin')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>change password</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}"  class="form-pill">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput3">Current password</label>
                <input type="password" class="form-control" name="oldpassword" id="current_password" placeholder="current password">
                @error('oldpassword')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword3">new Password</label>
                <input type="password" class="form-control" name = "password" id="password" placeholder="new Password">
                 @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
              <div class="form-group">
                <label for="exampleFormControlPassword3">confirmPassword</label>
                <input type="password" class="form-control" name = "password_confirmation" id="password_confirmation" placeholder="confirm Password">
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-default">save</button>
        </form>
    </div>
</div>
@endsection
