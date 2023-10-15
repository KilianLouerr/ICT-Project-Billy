@extends('layout')
@section('title', 'Robots beheren')
@section('content')
<section>
    <h2>Robots beheren</h2>
</section>
<section class="flex-space-between">
    <div class="flex">
        <div>
            <b>Status:</b>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="all" name="status" value="all">
                <label class="form-check-label">Alle</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="active" name="status" value="active">
                <label class="form-check-label">Actief</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="inactive" name="status" value="inactive">
                <label class="form-check-label">Niet actief</label>
            </div>
        </div>
    </div>
    <div>
        <form action="/addRobot" method="get">
            <button class="btn btn-primary">Robot toevoegen</button>
        </form>
    </div>
</section>
<section>
    <table id="data-table" class="compact stripe">
        <thead>
            <tr>
                <th data>ID</th>
                <th>Naam</th>
                <th data-sortable="false" width="100">Status</th>
                <th>Tour</th>
                <th data-sortable="false" width="100">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($robots as $robot)
            <tr>
                <td>{{$robot['id']}}</td>
                <td>{{$robot['name']}}</td>
                <td>
                    <form action='/toggleButton' method='get'>
                        <input type='hidden' name="robotId" value="{{$robot['id']}}" />
                        @php
                            $statusText = ($robot['status'] == 'active') ? 'Actief' : 'Niet actief';
                        @endphp

                        <button class="btn btn-outline-primary">
                            {{ $statusText }}
                        </button>
                        
                    </form>
                </td>
                <td>
                    @if ($robot['tour_id'])
                    <span id='tour' class="font-weight-bold">{{ $tours->firstWhere('id', $robot['tour_id'])['name'] ?? '' }}</span>
                    @endif
                </td>
                <td>
                    <?php $id = "removeRobot" . $robot['id'] ?>
                    <form action="/removeRobot" method="get" id="{{$id}}">
                        <input type='hidden' name="robotId" value="{{$robot['id']}}" />
                        <button type="button" onclick="deleteConfirm({{$robot['id']}})" class="btn btn-outline-danger mr-1" id="delete">
                            <img src="/images/Delete.svg" alt="Button icon" width="20" class="button-icon">
                        </button>
                    </form>
                    <div class='buttons' id="robot{{$robot['id']}}">
                        <input type='hidden' name="robotId" value="{{$robot['id']}}" />
                        <button class="btn btn-outline-primary" id="edit" onclick="openModal('{{$robot['name']}}', '{{$robot['id']}}', '{{$robot['tour_id']}}')">
                            <img src="/images/Edit.svg" alt="Button icon" width="23" class="button-icon">
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th data>ID</th>
                <th>Naam</th>
                <th data-sortable="false" width="100">Status</th>
                <th>Tour</th>
                <th data-sortable="false" width="100">Acties</th>
            </tr>
        </tfoot>
    </table>
    <dialog class="modal" id="modal">
        <form action="/saveRobot" method="get">
            <input type="hidden" id='robotId' name="robotId" value="" />
            <input type="hidden" id='tourId' name="tourId" value="" />
            <label> Naam Robot: </label>
            <input id="robotNameInput" name="newRobotName" class="card-title" value="" />
            <label>Tour:</label>
            <select name="tourSelected" id='tourSelected'>
                @foreach ($tours as $tour)
                <option value="{{ $tour['id'] }}">{{ $tour['name'] }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-danger mr-1" type="button" onclick="closeModal()"><img src="/images/Cross.svg" alt="Button icon" width="20" class="button-icon"></button>
            <button class="btn btn-outline-primary" onclick="checkBtn()"><img src="/images/Check.svg" alt="Button icon" width="20" class="button-icon"></button>
        </form>
    </dialog>
</section>
<script type="text/javascript" src="{{ asset('js/manageRobot.js') }}"></script>
@endsection
