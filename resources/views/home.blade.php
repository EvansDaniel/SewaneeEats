@extends('layout')

@section('head')
    <title>Sewanee Eats</title>
@stop

@section('body')
    <div id="push-fig"></div>
    <script>
        $(document).ready(function(){
            $("figure").fadeIn(500);
            $("#promo-p1").fadeIn(1000);
            $("#promo-p2").fadeIn(1000);
            $("#promo-place1").fadeIn(2000);
            $("#promo-place2").fadeIn(2200);
            $("#promo-place3").fadeIn(2000);
            $("#btn").fadeIn(1000);
        });
    </script>
    <figure>
        <!-- http://i67.tinypic.com/2w67w39.png responds with 503 error code -->
        @if(env('APP_ENV') === 'local')
            <img src="{{ asset('images/home.jpg') }}" class="img-responsive" alt="Smiley face">
        @else
            <img src="{{secure_asset('images/home.jpg')}}" class="img-responsive" alt="Smiley face">
        @endif
        <div style="margin: 0 auto;text-align: center">
            <a href="{{ route('list_restaurants') }}" class="btn" id="btn">ORDER NOW</a>
        </div>
    </figure>
    <section id="promo-section" class="container">
        <p class="row" id="promo-p1">
            BUYING FOOD ON THE MOUNTAIN MADE EASY
        </p>
        <p class="row" id="promo-p2">
            We offer express food delivery everywhere
        </p>
        <br> <br>
        <div class="row" id="promo-places">
            <div class="col-lg-3 col-md-3 col-sm-10 col-sm-offset-1 col-xs-offset-1 col-xs-10" id="promo-place1">
                @if(env('APP_ENV') === 'local')
                    <img class="img-circle img-thumbnail" src="{{asset('images/locations/humphreys.jpg')}}"><br><br>
                @else
                <img class="img-circle img-thumbnail" src="{{secure_asset('images/locations/humphreys.jpg')}}"><br><br>
                @endif
                <p class="col-md-12 col-lg-12">Order from your residential room</p>
            </div>
            <div class="col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-offset-1 col-xs-10" id="promo-place2">
                @if(env('APP_ENV') === 'local')
                    <img class="img-circle img-thumbnail" src="{{ asset('images/locations/dupont.jpg') }}"><br><br>
                @else
                    <img class="img-circle img-thumbnail" src="{{secure_asset('images/locations/dupont.jpg')}}"><br><br>
                @endif
                <p class="col-md-12 col-lg-12">Your favorite place to study</p>
            </div>
            <div class="col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-offset-1 col-xs-10" id="promo-place3">
                @if(env('APP_ENV') === 'local')
                    <img class="img-circle img-thumbnail" src="{{ asset('images/locations/kappasig.jpg') }}"><br><br>
                @else
                    <img class="img-circle img-thumbnail" src="{{secure_asset('images/locations/kappasig.jpg')}}"><br>
                    <br>
                @endif
                <p>Or your fraternity/sorority house</p>
            </div>
        </div>
        <div class="row">
            <a href="{{ route('list_restaurants') }}" id="promo-order-button" class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                ORDER NOW
            </a>
        </div>
    </section>
@stop
