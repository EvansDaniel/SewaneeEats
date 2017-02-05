@extends('layout')

@section('head')
    <title>Sewanee Eats | Restaurants</title>
@stop

@section('body')
    <link rel="stylesheet" href="{{asset('css/restaurants.css')}}">
    <br><br><br>
    <header class="container header">
        <h5 id="mountain">RESTAURANTS ON THE MOUNTAIN</h5>
        <hr>
    </header>
    <script>
        $(document).ready(function () {
            change_heights();
        })
        function change_heights(){
            var imgs = $(".img-responsive");
            var img_model = imgs.get(0);
            var li_h = img_model.height;
            p(li_h);
            p(imgs.length);
            imgs.each(function () {
                $(this).css("height", li_h);
            })

        }
    </script>
    <ul class="list-group container" id="restaurant-group">
        <li class="restaurant list-group-item col-lg-3 col-md-3 col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2">
                <a>
                    <img id="rest-images"  class="img-responsive" src="{{asset('images/stirling_new.jpg')}}">
                </a>

            </li>
        <li class="restaurant list-group-item  col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-1 col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2">
                <a>
                    <img id="rest-images" class="img-responsive" src="{{asset('images/bluechair_cafe.jpg')}}">
                </a>

            </li>


        <li class="restaurant list-group-item col-lg-3 col-md-3 col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2">
                <a>
                    <img id="rest-images" class="img-responsive " src="{{asset('images/tavern_new.jpg')}}">
                </a>

            </li>

        <li class="restaurant list-group-item col-lg-3 col-md-3 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 col-xs-8 col-xs-offset-2">
            <a>
                <img id="rest-images" class="img-responsive" src="{{asset('images/shenanigans.jpg')}}">
            </a>

        </li>

        <li class="restaurant col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 list-group-item">
                <a>
                    <img id="rest-images" class="img-responsive" src="{{asset('images/crossroads_new.jpg')}}">
                </a>

            </li>
        <li class="restaurant list-group-item col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2">
                <a>
                    <img id="rest-images" class="img-responsive" src="{{asset('images/ivy_wild.jpg')}}">
                </a>
            </li>
        <li class="restaurant list-group-item col-lg-3 col-md-3 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 col-xs-8 col-xs-offset-2">
                <a>
                    <img id="rest-images" class="img-responsive" src="{{asset('images/pub.png')}}">
                </a>

        </li>

    </ul>
    <div class="container">
        <h5 id="monteagle">RESTAURANTS IN MONTEAGLE</h5>
        <hr>
        <p>Coming soon!</p>

    </div>
@stop
