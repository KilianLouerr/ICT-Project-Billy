@extends('layout')
@section('title', 'Tours beheren')
@section('content')
<section>
    <h2>Tours beheren</h2>
</section>
<section>
    <div class="grid-vertical">
        <form action="/addTour" method="get">
            <button type="submit">Tour Toevoegen</button>
        </form>
        <div class="grid-vertical">
            <div class="table-container">
                <table id="data-table" class="compact stripe">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Beschrijving</th>
                            <th data-sortable="false" width="100">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tours as $tour)
                        <tr data-id="{{ $tour['id'] }}">
                            <td>
                                {{$tour['name']}}
                            </td>
                            <td>
                                {{$tour['description']}}
                            </td>
                            <td>
                                <?php $id = "removeTour" . $tour['id'] ?>
                                <form action="/removeTour" method="get" id="{{$id}}">
                                    <input type="hidden" name="id" value="{{ $tour['id'] }}">
                                    <button class="btn btn-outline-danger" onclick="deleteConfirm({{$tour['id']}})" type="button">
                                        <img src="/images/Delete.svg" alt="Button icon" width="20" class="button-icon">
                                    </button>
                                </form>

                                <input type="hidden" name="tourId" value="{{ $tour['id'] }}">
                                <button class="btn btn-outline-primary mr-1" type="submit" onclick="openModal({{$tour['id']}})">
                                    <img src="/images/Edit.svg" alt="Button icon" width="20" class="button-icon">
                                </button>
                            </td>
                            <?php
                            $class = "modal" . $tour['id'];
                            $id = "routeMediaList" . $tour['id'];
                            ?>
                            <dialog class="{{$class}}">
                                <div>
                                    <button class="close-button" onclick="closeDialog({{$tour['id']}})">
                                        <img src="/images/Cross.svg" alt="Button icon" width="30" class="button-icon">
                                    </button>
                                    <form action="/saveAddTour" method="get">
                                        <div class="grid-vertical">
                                            <label for="tourName"><b>Naam: </b></label>
                                            <input onChange="valueChanged()" id="nameLabel" name="tourName" value="{{$tour['name']}}" required>
                                            <label><b>Route en media lijst: </b></label>
                                            <ul id="{{$id}}" style="height: 200px; overflow-y: scroll; padding: 8px; color: gray; margin: 0; border: 1px solid gray;">
                                            </ul>
                                            <button name="toevoegenBtn" value="{{ $tour['id']}}" type="submit" class="button">Toevoegen</button>
                                            <label for="tourDescription"><b>Beschrijving: </b></label>

                                            <input onChange="valueChanged()" style="min-height: 80px; width: 100%" name="tourDescription" value="{{$tour['description']}}" />

                                            <input type="hidden" name="thisTourId" value="{{ $tour['id'] }}" required>

                                            <div>
                                                <button name="opslaanBtn" type="submit">Opslaan</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </dialog>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Naam</th>
                            <th>Beschrijving</th>
                            <th>Acties</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/manageTour.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</section>
@endsection
