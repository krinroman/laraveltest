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
                    <ul>
                        <li>
                            
                        </li>
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