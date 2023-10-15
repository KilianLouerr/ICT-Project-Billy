@extends('layout')
@section('title', 'Routes beheren')
@section('content')
<section>
    <h2>Routes beheren</h2>
</section>
<section>
    <div class="grid-vertical-to-horizontal">
        <div>
            <form action="{{route('addInstruction')}}" method="POST">
                @csrf
                <label>Waarde:</label><br>
                <input type="text" name="value" placeholder="vooruit: m | draaien: °" required>
                @error('value')
                <div class="error" style="color: red;">{{ $message }}</div>
                @enderror
                <br>
                <br>
                @csrf
                <button type="submit" name="command" value="forward" class="buttonForIcon" title="Vooruit">
                    <img src="/images/Forward.svg" alt="Button icon" width="20" class="button-icon">
                    Vooruit
                </button>
                @csrf
                <button type="submit" name="command" value="turn" class="buttonForIcon" title="Draaien">
                    <img src="/images/Turn.svg" alt="Button icon" width="20" class="button-icon">
                    Draaien
                </button>
                <br>
            </form>
            <br>
            <form action="/removeSelectedRoutes" method="POST" id="removeRouteForm">
                @csrf
                @if(count($routes) > 0)
                <label>Routes: </label>
                <br>
                <select name="allRoutes[]" id="allRoutesSelect" size="5" multiple>
                    @foreach ($routes as $route)
                    <option value="{{$route['id']}}">
                        <strong>{{ $points[$route['start_point']]['name'] }} - {{ $points[$route['end_point']]['name'] }}</strong>
                    </option>
                    @endforeach
                </select>
                <br>
                <button type="submit" class="button">Verwijderen</button>
                @endif
            </form>
        </div>
        <div>
            <form action="/addRoute" method="POST">
                @csrf
                <label for="start_point">Startpunt:</label>
                <div class="select">
                    <select name="start_point" id="start_point" onchange="setSelectPoints(this)">
                        <option value="0" disabled selected>selecteer een startpunt</option>
                        @if(count($points) == 0)
                        <option value="0">Geen punten</option>
                        @else
                        @foreach ($points as $point)
                        <option value="{{ $point['id'] }}" title="{{ $point['description'] }}" {{ old('start_point') == $point['id'] ? 'selected' : '' }}>
                            {{ $point['name'] }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                @error('start_point')
                <div class="error" style="color: red;">{{ $message }}</div>
                @enderror
                <br><br>
                <div class="opt" style="display: inline-block; max-height: 300px; overflow: auto;">
                    <table style="border-collapse: collapse;">
                        <tbody>
                            @foreach ($instructions as $key => $instruction)
                            <tr>
                                <td style="padding: 8px; color: gray; text-align: center;">
                                    @if ($instruction['command'] === 'forward')
                                    <img src="/images/Forward.svg" id="img{{$key}}" width="20" alt="Forward">
                                    @elseif ($instruction['command'] === 'turn')
                                    <img src="/images/Turn.svg" id="img{{$key}}" width="20" alt="Turn">
                                    @endif
                                </td>
                                <td>
                                    <select disabled name="editCommandDropdown{{$key}}" id="idEditCommandDropdown{{$key}}">
                                        <option selected>{{$instruction['command']}}</option>
                                        @if ($instruction['command'] === 'turn')
                                        <option value="forward">forward</option>
                                        @else
                                        <option value="turn">turn</option>
                                        @endif
                                    </select>
                                </td>
                                <td style="padding: 8px; color: gray; text-align: center;">
                                    <input name="editedValue{{$key}}" disabled id="input{{$key}}" value="{{$instruction['value']}}" size="3">
                                </td>
                                <td>
                                    <button type="button" onclick="editInput({{$key}})" id="editButton{{$key}}" title="Bewerken">
                                        <img src="/images/Edit.svg" alt="Edit icon" width="23" class="button-icon">
                                    </button>
                                </td>
                                <td>
                                    <button type="button" disabled onclick="saveEdit({{$key}})" id="saveButton{{$key}}" title="Opslaan">
                                        <img src="/images/Save.svg" alt="Save icon" width="23" class="button-icon">
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="button" onclick="window.location='{{route('removeInstruction', $key)}}'" title="Verwijderen">
                                        <img src="/images/Delete.svg" alt="Delete icon" width="20" class="button-icon">
                                    </button>
                                </td>
                                @error($key)
                                <div class="error" style="color: red;">{{ $message }}</div>
                                @enderror
                                @endforeach
                        </tbody>
                    </table>
                    @error('instructionsError')
                    <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <br><br>
                <label for="end_point">Eindpunt:</label>
                <div class="select">
                    <select name="end_point" id="end_point" onchange="setSelectPoints(this)">
                        <option value="0" disabled selected>selecteer een eindpunt</option>
                        @if(count($points) == 0)
                        <option value="0">Geen punten</option>
                        @else
                        @foreach ($points as $point)
                        <option value="{{ $point['id'] }}" title="{{ $point['description'] }}" {{ old('end_point') == $point['id'] ? 'selected' : '' }}>
                            {{ $point['name'] }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                @error('end_point')
                <div class="error" style="color: red;">{{ $message }}</div>
                @enderror
                <br><br>
                <table>
                    <tr>
                        <td>
                            <button type="submit" class="button">Opslaan</button>
                        </td>
                        <td>
                            <button type="button" class="button" onclick="window.location='{{route('removeInstructions')}}'">Instructies verwijderen</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>
<script type="text/javascript" src="{{ asset('js/manageRoutes.js') }}"></script>
@endsection
