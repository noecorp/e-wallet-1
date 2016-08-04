@extends('layouts.app');

@section('head')
	<link href="{{ url('public/css/image-uploader.css') }}" rel="stylesheet" >
	<link href="{{ url('public/css/profile.css') }}" rel="stylesheet" >
@stop

@section('content')

	<div class="row">

		@include('common.user-card')

		<div class="col-md-8">
			<div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                        </li>
                        <li>
                            <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <!-- PERSONAL INFO TAB -->
                        <div class="tab-pane active" id="tab_1_1">
                            <form role="form" method="post" action="{{ url('/update-settings') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">

                                <div class="form-group">
                                    <label class="control-label">Full Name</label>
                                    <input name="name" type="text" value="{{ $user->name }}" class="form-control" />
                                 </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input name="email" type="text" value="{{ $user->email }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Phone</label>
                                    <input name="phone" type="text" value="{{ $user->phone }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    {{ AppHelpers::imageUploadInput('image',$user->id,AppHelpers::getImageUrl($user->featuredImage,125,125) ) }}
                                </div>

                                <div class="margiv-top-10">
                                    <button type="submit" class="btn green"> Save Changes </a>
                                </div>
                            </form>
                        </div>
                        <!-- END PERSONAL INFO TAB -->
                        
                        <!-- CHANGE PASSWORD TAB -->
                        <div class="tab-pane" id="tab_1_3">
                            <form method="post" action="{{ url('/update-password') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">

                                <div class="form-group">
                                    <label class="control-label">Current Password</label>
                                    <input name="old_password" type="password" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">New Password</label>
                                    <input type="password" name="password" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Re-type New Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" /> </div>
                                <div class="margin-top-10">
                                    <button type="submit" class="btn green"> Change Password </a>
                                </div>
                            </form>
                        </div>
                        <!-- END CHANGE PASSWORD TAB -->
                        
                    </div>
                </div>
            </div>
		</div>

    </div>

@include('common.image-uploader')
@stop