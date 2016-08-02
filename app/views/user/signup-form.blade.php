<form class="register-form" action="{{ url('/signup') }}" method="post" enctype="multipart/form-data">
        
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-title">
        <span class="form-title">Sign Up</span>
    </div>
    <p class="hint"> Enter your personal details below: </p>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Full Name</label>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="name" />
    </div>

    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" />
    </div>
    
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Phone</label>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Phone" name="phone" />
    </div>

    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Phone</label>
        <input class="form-control placeholder-no-fix" type="file" name="image" />
    </div>
    
    
    <p class="hint"> Password: </p>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" />
    </div>
    
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" />
    </div>
    
    <div class="form-group margin-top-20 margin-bottom-20">
        <label class="check">
            <input type="checkbox" name="tnc" />
            <span class="loginblue-font">I agree to the </span>
            <a href="javascript:;" class="loginblue-link">Terms of Service</a>
            <span class="loginblue-font">and</span>
            <a href="javascript:;" class="loginblue-link">Privacy Policy </a>
        </label>
        <div id="register_tnc_error"> </div>
    </div>
    
    <div class="form-actions">
        <button type="button" id="register-back-btn" class="btn btn-default">Back</button>
        <button type="submit" id="register-submit-btn" class="btn red uppercase pull-right">Submit</button>
    </div>

</form>