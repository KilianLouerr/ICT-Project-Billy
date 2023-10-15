<nav class="navbar">
    <div class="container flex-space-between">
        <h1>UCLL Guided Tours</h1>
        <div>
            <a href="{{route('dashboard')}}">Dashboard</a>
            @auth
            <a href="{{route('manageTours')}}">Tours beheren</a>
            <a href="{{route('manageRoutes')}}">Routes beheren</a>
            <a href="{{route('manageLocations')}}">Punten beheren</a>
            <a href="{{route('manageRobots','all')}}">Robots beheren</a>
            @endauth
            @auth
            <a href="{{route('logout')}}">Logout</a>
            @else
            <a href="{{route('login')}}">Login</a>
            @endauth
        </div>
    </div>
</nav>


