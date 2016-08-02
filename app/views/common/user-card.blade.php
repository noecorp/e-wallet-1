<div class="col-md-4">
	<div class="portlet light profile-sidebar-portlet bordered">
	    <div class="profile-userpic">
	        <img src="{{ AppHelpers::getImageUrl($user->featuredImage,150,150) }}" class="img-responsive" alt="{{ $user->name }}">
	    </div>
	    
	    <div class="profile-usertitle">
	        <div class="profile-usertitle-name"> {{ $user->name  }} </div>
	        <div class="profile-usertitle-job"> {{ $user->balance.'$' }} </div>
	    </div>
	    <!-- END SIDEBAR USER TITLE -->
	    <!-- SIDEBAR BUTTONS -->
	    @if((Auth::user()->role == 1 && Auth::user()-> id != $user->id) || ( Auth::user()->role == 0 || $user->id == Auth::user()->id ) )
	        <div class="profile-userbuttons">
	            <button type="submit" class="btn ``btn-circle red btn-sm">Delete</a>
	        </div>
	    @endif
	    <!-- END SIDEBAR BUTTONS -->
	    <!-- SIDEBAR MENU -->
	    <div class="profile-usermenu">
	        <ul class="nav">
	            <li>
	                <a href="{{ AppHelpers::generateUserProfileLink($user->id) }}">
	                    <i class="icon-home"></i> Overview
	                </a>
	            </li>
	            @if(Auth::user()->can('update-settings',$user))
	            <li>
	                <a href="{{ AppHelpers::joinPaths( AppHelpers::generateUserProfileLink($user->id),'settings' ); }}">
	                    <i class="icon-settings"></i> Account Settings
	                </a>
	            </li>
	            @endif
	            <li>
	                <a href="{{ AppHelpers::joinPaths( AppHelpers::generateUserProfileLink($user->id),'banks' ); }}">
	                    <i class="icon-wallet"></i> Banks
	                </a>
	            </li>

	            <li>
	                <a href="{{ AppHelpers::joinPaths( AppHelpers::generateUserProfileLink($user->id),'deposits' ); }}">
	                    <i class="icon-cloud-upload"></i> Deposits
	                </a>
	            </li>

	            <li>
	                <a href="{{ AppHelpers::joinPaths( AppHelpers::generateUserProfileLink($user->id),'withdrawals' ); }}">
	                    <i class="icon-cloud-download"></i> Withdrawals
	                </a>
	            </li>
	            <li>
	                <a href="{{ AppHelpers::joinPaths( AppHelpers::generateUserProfileLink($user->id),'transactions' ); }}">
	                    <i class="icon-directions"></i> Transactions
	                </a>
	            </li>
	        </ul>
	    </div>
	    <!-- END MENU -->
	</div><!-- end of portlet -->
</div>