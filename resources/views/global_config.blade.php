{{-- JQuery --}}
<script src= {{ secure_asset('js/app.js') }}></script>
{{-- Bootstrap --}}
<link rel="stylesheet" href= {{ secure_asset('css/app.css') }}>

<!-- Stripe JS -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script>
  function getBaseUrl() {
    var pathArray = location.href.split('/');
    var protocol = pathArray[0];
    var host = pathArray[2];
    return protocol + '//' + host;
  }
  API_URL = getBaseUrl() + "/api/v1/";
  // debugging helper function
  function p($obj) {
    console.log($obj);
  }
//  $(document).ready(function () {
//      var bd = $(window );
//      var h = bd.height();
//      h = h - $("#main-container").height();
//      if( h >0) {
//          $("#push-div").css("height", h);
//      }
//
//  });
</script>

<meta name="viewport" content="width=device-width, initial-scale=1">
