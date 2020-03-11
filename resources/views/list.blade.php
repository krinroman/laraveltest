@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                        <div class="col-md-8 col-md-offset-1">
                            <input id="input_add" type="text" class="form-control">    
                        </div>
                        <div class="col-md-2">
                            <button id="button_add" class="btn btn-primary">Добавить</button>
                        </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul id="list">
                        @foreach ($listEntry as $entry)
                            <li class="entry show-entry" id="entry_{{$entry->id}}">
                                <span name="id">{{ $entry->id}}</span>.
                                <span name="value">{{$entry->value}}</span>
                                <input name="input" type="text" class="form-control" value="{{$entry->value}}"> 
                                <button name="edit_button" class="show-entry-button" data-id="{{ $entry->id}}">✐</button>
                                <button name="del_button" class="show-entry-button" data-id="{{ $entry->id}}">✕</button>
                                <button name="save_button" class="btn btn-primary edit-entry-button" data-id="{{ $entry->id}}">Сохранить</button>
                                <button name="close_button" class="btn btn-primary edit-entry-button" data-id="{{ $entry->id}}">Отмена</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="js/list.js"></script>
@endsection