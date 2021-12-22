@extends('layouts.app')

@section('content')

<script>
    var pusher;

    var latitude = 0;
    var longitude = 0;

    $(document).ready(function() {

        Pusher.logToConsole = true;
        pusher = new Pusher('25760117103cda51d5ae', {
            cluster: 'ap2'
        });


        $("#connect-btn").click(function(e) {
            var user_id = $("#userid").val();
            subscribe(user_id);
        });

        setInterval(modifyLocation, 10000); // 10 seconds
    })

    function subscribe(user_id) {
        var channel = pusher.subscribe('driver-' + user_id);

        channel.bind('LURequest', function(data) {

            /**
             * Update location
             */

            axios({
                    method: 'post',
                    url: "/api/location/update/" + user_id,
                    data: {
                        lat: latitude,
                        long: longitude
                    }
                })
                .then(function(response) {
                    console.log(response.data);
                });
        });
    }

    function modifyLocation() {
        latitude += Math.random();
        latitude -= Math.random();

        longitude += Math.random();
        longitude -= Math.random();

        console.log(`New location: ${latitude}, ${longitude}`);
    }
</script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Id') }}</div>

                <div class="card-body">
                    <input type="number" class="form-control" id="userid" placeholder="Enter User ID">
                    <button class="btn btn-sm btn-primary mt-2" id="connect-btn">Connect</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection