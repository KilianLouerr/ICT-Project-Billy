@extends('layout')
@section('title', 'Dashboard')
@section('content')
<section>
    <h2>Dashboard</h2>
</section>
<section>
    @if (count($robots) == 0)
    <p>Er zijn geen actieve robots.</p>
    @else
    <div class="grid-vertical-to-horizontal">
        @foreach ($robots as $robot)
        <div class="card" id="tour">
            <div>
                <div>
                    <h5>{{ $tours->firstWhere('id', $robot['tour_id'])['name'] ?? '' }}</h5>
                    <p>Status: <br>
                        <span id="status" class="font-weight-bold">Vertrokken</span>
                    </p>
                    <p>Locatie: <br>
                        <span id="locatie" class="font-weight-bold">Om de hoek</span>
                    </p>
                    <p>Robot: <br>
                        <span id="robot{{$robot['id']}}" class="font-weight-bold">{{$robot['name']}}</span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</section>
@endsection
