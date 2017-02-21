<!-- Built by Daniel Evans (evansdb0@sewanee.edu), Tariro Kandemiri, and Blaise Iradukunda -->

<html>
<head>
    @include('global_config')
    <link rel="icon" href="{{asset('images/mtneats.png')}}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/home.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900,900i" rel="stylesheet">
    {{--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>--}}
</head>
<body>
<div id="main-container" class="container-fluid">
    <!-- Status messages to user about what they are doing -->
    <br><br><br><br>
    <div id="header" style="display: none">
        <h1>Sewanee Eats launches this Thursday at 12PM!</h1>
    </div>
    <div id="clockdiv">
        <div id="daysDiv" style="display: none">
            <span id="days"></span>
            <div class="smalltext">Days</div>
        </div>
        <div id="hoursDiv" style="display: none">
            <span id="hours"></span>
            <div class="smalltext">Hours</div>
        </div>
        <div id="minDiv" style="display: none">
            <span id="minutes"></span>
            <div class="smalltext">Minutes</div>
        </div>
        <div id="secDiv" style="display: none">
            <span id="seconds"></span>
            <div class="smalltext">Seconds</div>
        </div>
    </div>

    <script>
      getTime();
      // cool animations
      $('#header').fadeIn(2000);
      setTimeout(function () {
        $('#daysDiv').fadeIn(1000);
      }, 250);
      setTimeout(function () {
        $('#hoursDiv').fadeIn(1000);
      }, 500);
      setTimeout(function () {
        $('#minDiv').fadeIn(1000);
      }, 750);
      setTimeout(function () {
        $('#secDiv').fadeIn(1000);
      }, 1000);
      // Set the date we're counting down to
      var countDownDate = new Date("Feb 24, 2017 12:00:00").getTime();

      // Update the count down every 1 second
      var x = setInterval(function () {
        getTime();
      }, 1000);

      function getTime() {
        $.ajax({
          url: getBaseUrl() + '/time'
        }).done(function (result) {
          // Get todays date and time
          var now = new Date(result).getTime();

          // Find the distance between now an the count down date
          var distance = countDownDate - now;

          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          $('#days').text(days);
          $('#hours').text(hours);
          $('#minutes').text(minutes);
          $('#seconds').text(seconds);

          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x);
            $('#days').text(0);
            $('#hours').text(0);
            $('#minutes').text(0);
            $('#seconds').text(0);
          }
        });
      }

    </script>


    <div id="push-div"></div>
    <footer id="footer" class="col-xs-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
        <br>
        <p>COPYRIGHT (C) SEWANEE EATS</p>
        <br>
    </footer>

    <style>
        body {
            text-align: center;
            background: #7459a5;
            font-family: sans-serif;
            font-weight: 100;
        }

        h1 {
            color: white;
            font-weight: 100;
            font-size: 40px;
            margin: 40px 0px 20px;
        }

        #clockdiv {
            font-family: sans-serif;
            color: white;
            display: inline-block;
            font-weight: 100;
            text-align: center;
            font-size: 30px;
        }

        #clockdiv > div {
            padding: 10px;
            border-radius: 3px;
            background: #00BF96;
            display: inline-block;
        }

        #clockdiv div > span {
            padding: 15px;
            border-radius: 3px;
            background: #00816A;
            display: inline-block;
        }

        .smalltext {
            padding-top: 5px;
            font-size: 16px;
        }
    </style>
</div>
</body>
</html>
