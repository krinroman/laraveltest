@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-12 home-wrapper">
                        <div class="col-md-4 d-flex flex-column">
                            <div class="img-avatar-wrapper">
                                @if(is_file('storage/images/avatar_user_'.Auth::user()->id.'.jpg'))
                                    <img class="img-fluid img-avatar" name="img_user" src='storage/images/avatar_user_{{ Auth::user()->id }}.jpg' />
                                @else
                                    <img class="img-fluid img-avatar" name="img_user" src="storage/images/default.jpg" />
                                @endif
                            </div>
                            <button class="btn btn-primary" id="download_image_button">Загрузить аватар</button>
                        </div>
                        <div class="col-md-8 content-block">
                            <span class="font-weight-bold">Логин: </span>
                            <span name="user_name">{{ Auth::user()->name }}</span><br/>
                            <span class="font-weight-bold">Электронная почта: </span>
                            <span name="user_name">{{ Auth::user()->email }}</span><br/>
                        </div>
                        <div class="upload-form-wrapper">
                            <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
                                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                <input type="file" id="switch_image" name="image" accept="image/jpeg" />
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="js/home.js"></script>
@endsection
