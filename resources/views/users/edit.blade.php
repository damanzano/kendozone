@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/userCreate.js') !!}
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}

@stop
@section('styles')
    {!! Html::style('css/pages/userCreate.css') !!}
@stop
@section('breadcrumbs')
    @if (!is_null($user->id))
        {!! Breadcrumbs::render('users.edit', $user) !!}
    @else
        {!! Breadcrumbs::render('users.create') !!}

    @endif
@stop
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="content">
            @if (!is_null($user->id))
            {!! Form::model($user, ['method'=>"PATCH",
                                    'route' => array('users.update', $user->slug),
                                    'enctype' => 'multipart/form-data',
                                    'id' => 'form']) !!}

            @else

            {!! Form::open(['url'=>URL::action('UserController@store'),'enctype' => 'multipart/form-data']) !!}

            @endif




                    <!-- Detached content -->
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">
                    <!-- Simple panel 1 : General Data-->
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('core.general_data')}}">
                                    <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>
                                </fieldset>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('name', trans('core.username')) !!}
                                                    @if (!is_null($user->id))
                                                        {!!  Form::label('name', $user->name, ['class' => 'form-control', "disabled" ]) !!}
                                                        {!!  Form::hidden('name', $user->name) !!}
                                                    @else
                                                        {!!  Form::text('name', $user->name, ['class' => 'form-control' ]) !!}
                                                    @endif

                                                    {!!  Form::hidden('avatar',$user->avatar) !!}
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('firstname', trans('core.firstname')) !!}
                                                    {!!  Form::text('firstname', old('firstname'), ['class' => 'form-control']) !!}


                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('lastname', trans('core.lastname')) !!}
                                                    {!!  Form::text('lastname', old('lastname'), ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('grade_id', trans('core.grade')) !!}
                                                    {!!  Form::select('grade_id', $grades ,null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-md-6  ">
                                        <div class="form-group">
                                            {!!  Form::label('avatar', trans('core.avatar')) !!}
                                            <div id="fileInput" class="dropzone text-center">
                                                <div class="fallback">
                                                    <input name="file" type="file"/>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                        <div class="form-group">
                                            {!!  Form::label('countryId', trans('core.country')) !!}
                                            {!!  Form::select('countryId', $countries,484, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-success">{{trans("core.save")}}</button>
                            </div>
                        </div>


                        <!-- /simple panel -->
                        <!-- Simple panel 2 : Venue -->
                    </div>


                    <!-- /detached content -->
                </div>
                <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="Venue">
                                    <a name="place">
                                        <legend class="text-semibold">{{Lang::get('core.account')}}</legend>
                                    </a>
                                </fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('email', trans('core.email')) !!}
                                                    {!!  Form::email('email',old('email'), ['class' => 'form-control']) !!}
                                                    <p class="help-block">{{  Lang::get('core.email_desc') }}</p>

                                                </div>
                                            </div>
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('role_id', trans('core.role')) !!}
                                                    @if (Auth::user()->isSuperAdmin())
                                                        @if (!is_null($user->id))
                                                            {!!  Form::select('role_id', $roles,old('role_id'), ['class' => 'form-control']) !!}
                                                        @else
                                                            {!!  Form::select('role_id', $roles,Config::get('constants.ROLE_USER'), ['class' => 'form-control']) !!}
                                                        @endif
                                                    @else
                                                        {!!  Form::label('role_id', $user->role->name, ['class' => 'form-control', "disabled"]) !!}
                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0 ">
                                                <div class="form-group">
                                                    {!!  Form::label('password', trans('core.password')) !!}
                                                    {!!  Form::password('password', ['class' => 'form-control']) !!}
                                                    <p class="help-block">{{  Lang::get('core.left_password_blank') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">

                                                <div class="form-group">
                                                    {!!  Form::label('password_confirmation', trans('auth.password_confirmation')) !!}
                                                    {!!  Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                                    <p class="help-block">{{  Lang::get('core.left_password_blank') }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div align="right">
                                    <button type="submit"
                                            class="btn btn-success">{{trans("core.save")}}</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

            {!! Form::close()!!}

        </div>

        <script>
            var maxImageWidth = 100, maxImageHeight = 100;

            Dropzone.autoDiscover = false;
            $(document).ready(function () {

                var initialPic = "{{ $user->avatar }}";
                var onlyPic = initialPic.substring(initialPic.lastIndexOf('/') + 1);

                var uploadUrl = "{{ URL::action('UserController@uploadAvatar',$user->slug) }}";
                var avatarHiddenField = $('input[name=avatar]');

                new Dropzone('#fileInput', {
                    autoProcessQueue: true,
                    uploadMultiple: false,
                    parallelUploads: 100,
                    acceptedFiles: "image/jpeg,image/png,image/gif",

                    dictRemoveFile:'{{ trans('core.remove') }}',
                    dictDefaultMessage:'Upload file',
                    addRemoveLinks: 'dictRemoveFile',
                    url: uploadUrl,
                    maxFiles: 1,

                    init: function () {
                        var myDropzone = this;
                        var mockFile = {name: onlyPic, size: 2000};
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, initialPic);
                        myDropzone.emit("complete", mockFile);
                        myDropzone.files.push(mockFile);
                        var existingFileCount = 0; // The number of files already uploaded
                        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;

                        myDropzone.on("thumbnail", function (file) {
                            if (file.width < maxImageWidth || file.height < maxImageHeight) {
                                file.rejectDimensions();
                            }
                            else {
                                file.acceptDimensions();
                            }
                        });


                        myDropzone.on("addedfile", function () {
                            if (this.files[1] != null) {
                                this.removeFile(this.files[0]);
                            }
                        });

                        myDropzone.on('success', function (file, response) {
                            avatarHiddenField.val(response['avatar']);
                        });


                    },
                    accept: function (file, done) {
                        file.acceptDimensions = done;
                        file.rejectDimensions = function () {
                            done("Invalid dimension.");
                        };
                        // Of course you could also just put the `done` function in the file
                        // and call it either with or without error in the `thumbnail` event
                        // callback, but I think that this is cleaner.
                    },
                    removedfile: function(file) {
//                        var name = file.name;
//                        $.ajax({
//                            type: 'POST',
//                            url: 'delete.php',
//                            data: "id="+name,
//                            dataType: 'html'
//                        });
                        avatarHiddenField.val('');
                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    },
                    maxfilesexceeded: function (file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    },

                })
            })
        </script>
        {!! JsValidator::formRequest('App\Http\Requests\UserRequest') !!}

    </div>
@stop
