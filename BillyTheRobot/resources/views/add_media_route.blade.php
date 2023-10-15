@extends('layout')
@section('title', 'MediaRoute')
@section('content')
<section>
    <h2>Media en/of route toevoegen</h2>
</section>
<div class="center-content">
    <label for="type-select">Toevoegen:</label>
    <select id="type-select">
        <option disabled selected>Selecteer</option>
        <option value="media">Media</option>
        <option value="route">Route</option>
    </select>
    <div id="media-form" style="display: none;">
        <form action='/linkMedia' method="get">
            <input name="tourId" type='hidden' value="{{$idTour}}" />
            <input name="order" type='hidden' value="{{$order}}" />
            <h2 style="color: black"> Media</h2>
            <label>Naam Media:</label>
            <input type="text" id="mediaName" name='mediaName'>
            <br>
            <label for="media-upload">Medialink Uploaden:</label>
            <input id="mediaLinkInput" type="text" name='mediaLink'>
            <br>
            <label>HTML:</label>
            <br>
            <textarea id="html-code" name='mediaHtml'></textarea>
            <br>
            <button id="media-toevoegen" disabled>Media Toevoegen</button>
        </form>
    </div>
    <div id="route-form" style="display: none;">
        <form action='/linkRoute' method="get">
            <input name="tourId" type='hidden' value="{{$idTour}}" />
            <input name="order" type='hidden' value="{{$order}}" />
            <h2 style="padding: 8px; color: gray;">Route Lijst</h2>
            <div>
                <select size="20" style='overflow-y: scroll;' id="routeSelect" name='selectedRoute'>
                    <option disabled>Routes</option>
                    @foreach ($routes as $route)
                    <option value='{{$route['id']}}'> {{$route['sname'] . " - " . $route['ename']}} </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" id="routeToevoegen" disabled>Route Toevoegen</button>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/addMediaRoute.js') }}"></script>
@endsection
