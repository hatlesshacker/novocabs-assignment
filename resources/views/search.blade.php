@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Location') }}</div>

                <div class="card-body">
                    <form action="/location/searchresult" method="get">
                        <input type="text" name="latitude" class="form-control" placeholder="Enter Latitude">
                        <input type="text" name="longitude" class="form-control mt-2" placeholder="Enter Longitude">
                        <input type="range" name="radius" class="form-control-range" min="0" max="10">
                        <button class="btn btn-sm btn-primary mt-2" type="submit">Connect</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection