@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>home slider</h4>
                <a href="{{ route('add.slider') }}"><button class="btn btn-info">Add slider</button></a>
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
                            All sliders
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SL NO</th>
                                <th scope="col">Slider Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">image</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                               {{-- @php($i = 1) --}}
                                @foreach ( $sliders as $slider )

                                <tr>
                                    <th scope="row">{{ $loop->index +1 }}</th>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td><img src="{{ asset($slider->image) }}" style="height: 40px ; width:70px ; " alt=""></td>

                                    <td>
                                        <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('slider/delete/'.$slider->id) }}" onclick="return confirm('Are You sure to delete')" class="btn btn-danger">Delete</a>

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
