@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>home about</h4>
                <a href="{{ route('add.about') }}"><button class="btn btn-info">Add about</button></a>
                <br>
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card-header">
                            All about data
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL NO</th>
                                    <th scope="col">home Title</th>
                                    <th scope="col">short Description</th>
                                    <th scope="col">long Description</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php($i = 1) --}}
                                @foreach ($homeabout as $about)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $about->title }}</td>
                                        <td>{{ $about->short_dis }}</td>
                                        <td>{{ $about->log_dis }}</td>

                                        <td>
                                            <a href="{{ url('about/edit/' . $about->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('about/delete/' . $about->id) }}"
                                                onclick="return confirm('Are You sure to delete')"
                                                class="btn btn-danger">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
