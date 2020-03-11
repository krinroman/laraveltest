@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                @if (Auth::guest())
                    Добро пожаловать, на наш сайт, чтобы воспользоваться другими возможностями,
                    пожалуйста <a href="/login">войдите</a> или <a href="/register">зарегистрируйтесь</a>.
                @else
                    Привет, {{ Auth::user()->name }}. Это главная страница.
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection