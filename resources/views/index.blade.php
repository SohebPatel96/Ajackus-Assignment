<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>




<body>

    <body>
        <div class="container">
            <div class="row">
                <div class="col s6 offset-s3">
                    <div class="card white lighten-2">
                        <div class="card-content">
                            <span class="card-title black-text">Calculate carbon foot print</span>
                            <form id="carbonForm" method="GET">
                                <div class="row">
                                    <div class="col s12">
                                        <div class="input-field col s12 black-text">
                                            <select class="black-text" id="activity_type">
                                                @foreach ($activityTypes as $activityType)
                                                <option value="{{$activityType['value']}}">{{$activityType['name']}}</option>
                                                @endforeach
                                            </select>
                                            <label>Select Activity Type</label>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <input id="activity" type="number" class="validate">
                                            <label for="activity">Activity - Distance in miles</label>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field col s12 black-text">
                                            <select class="black-text" id="country">
                                                @foreach ($countries as $country)
                                                <option value="{{$country['value']}}">{{$country['name']}}</option>
                                                @endforeach
                                            </select>
                                            <label>Select Country</label>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field col s12 black-text">
                                            <select class="black-text" id="mode">
                                                @foreach ($modes as $mode)
                                                <option value="{{$mode['value']}}">{{$mode['name']}}</option>
                                                @endforeach
                                            </select>
                                            <label>Select Model</label>
                                        </div>
                                    </div>
                                    <div class="col s12" style="text-align:center;" id="submit_form">
                                        <button class="waves-effect waves-light btn text-center" type="submit">Submit</button>
                                    </div>
                                    <div class="progress" id="progress" style="visibility: hidden;">
                                        <div class="indeterminate"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });

    $("#carbonForm").submit(function(e) {
        e.preventDefault();

        var activityType = $('#activity_type').val();
        var activity = $('#activity').val();
        var country = $('#country').val();
        var mode = $('#mode').val();

        document.getElementById("progress").style.visibility = "visible";
        document.getElementById("submit_form").style.visibility = "hidden";


        $.ajax({
            type: 'GET',
            url: '/api',
            contentType: 'application/json',
            data: {
                activityType: activityType,
                activity: activity,
                country: country,
                mode: mode
            },
            dataType: 'json',
            success: function(data) {
                var success = data['success'];
                if (success) {
                    var carbonFootPrint = data['carbonFootPrint'];
                    alert('Carbon foot print = ' + carbonFootPrint);
                } else {
                    var message = data['message'];
                    alert(message);
                }
                document.getElementById("progress").style.visibility = "hidden";
                document.getElementById("submit_form").style.visibility = "visible";
            },
            error: function(data) {
                document.getElementById("progress").style.visibility = "hidden";
                document.getElementById("submit_form").style.visibility = "visible";
                var errors = data.responseJSON;
                var key = ''; //print the last error from the array
                for (var prop in errors.errors) {
                    key = prop;
                }
                alert(errors.errors[key]);

            }
        });
    });
</script>

</html>
