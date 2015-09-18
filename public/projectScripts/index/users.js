
var baseUrl = $('#projectBaseUrl').val();

//alert(baseUrl);
function openSignUp(){
   $('#loginForm').modal('hide');
   $('#signUpForm').modal('show');
}
function forgotPassword(){
    $('#loginForm').modal('hide');
    $('#forgotPwswd').modal('show');
}
$('.userLogin').click(function(){
    var userLoginEmail = $('.userLoginEmail').val();
    var userLoginPassword = $('.userLoginPassword').val();
    var remember_me = ($('#remember_me').is(':checked'))? 1 : 0;
    
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var error = 0;
    if(userLoginEmail=='' || emailReg.test(userLoginEmail)==false){
        $('.userLoginEmail').css('border-color','red');
        error = 1;
    }else{
        $('.userLoginEmail').css('border-color','#ccc');
        error = 0;
    }
    if(userLoginPassword==''){
        $('.userLoginPassword').css('border-color','red');
        error = 1;
    }else{
        $('.userLoginPassword').css('border-color','#ccc');
        error = 0;
    }
    if(error==0){
        $.post(baseUrl + '/front-end/user/user-login', {userLoginEmail: userLoginEmail,userLoginPassword:userLoginPassword,remember_me:remember_me}, function (response) {
            
        },'json');
    }else{
        return false;
    }
});


$('.signUpButton').click(function(){
    var userName = $('.userName').val();
    var userPassword = $('.userPassword').val();
    var userEmail = $('.userEmail').val();
    var userMobile = $('.userMobile').val();
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var error = 0;
    if(userName==''){
        $('.userName').css('border-color','red');
        error = 1;
    }else{
        $('.userName').css('border-color','#ccc');
        error = 0;
    }
    if(userPassword==''){
        $('.userPassword').css('border-color','red');
        error = 1;
    }else{
        $('.userPassword').css('border-color','#ccc');
        error = 0;
    }
    if(userEmail=='' || emailReg.test(userEmail)==false){
        $('.userEmail').css('border-color','red');
        error = 1;
    }else{
        $('.userEmail').css('border-color','#ccc');
        error = 0;
    }
    
    if(error==0){
        $('.signUpButton').hide();
        $('#signUpLoader').show();
        $.post(baseUrl + '/front-end/user/user-register', {userName: userName,userPassword:userPassword,userEmail:userEmail,userMobile:userMobile}, function (response) {
            $('#signUpForm').modal('hide');
            $('#loginForm').modal('show'); 
            $('.userName,.userPassword,.userEmail,.userMobile').val('');
        });
    }else{
        return false;
    }
});

$('.forgotPswd').click(function(){
    var forgotEmail = $('#forgotEmail').val();
    var error = 0;
     if(forgotEmail==''){
        $('#forgotEmail').css('border-color','red');
        error = 1;
    }else{
        $('#forgotEmail').css('border-color','#ccc');
        error = 0;
    }
    if(error==0){
       // $('.signUpButton').hide();
       // $('#signUpLoader').show();
        $.post(baseUrl + '/front-end/user/forgot-password', {forgotEmail: forgotEmail}, function (response) {
            $('.messageBody').html('<p>We have sent the password reset instructions on '+forgotEmail+'. Kindly follow the instructions in the mail for resetting your password.</p>');
            
           // $('#signUpForm').modal('hide');
           // $('#loginForm').modal('show'); 
           // $('.userName,.userPassword,.userEmail,.userMobile').val('');
        });
    }else{
        return false;
    }
});


/* Facebook Login Script Start */

//Load the Facebook JS SDK
(function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
 }(document));

// Init the SDK upon load
window.fbAsyncInit = function() {
  FB.init({
    appId      : '129874794027773', // App ID
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });


// Specify the extended permissions needed to view user data
// The user will be asked to grant these permissions to the app (so only pick those that are needed)
        var permissions = [
          'email',
          'user_likes',
          'user_about_me',
          'user_birthday',
          'user_education_history',
          'user_hometown',
          'user_relationships',
          'user_relationship_details',
          'user_location',
          'user_religion_politics',
          'user_website',
          'user_work_history'
          ].join(',');

// Specify the user fields to query the OpenGraph for.
// Some values are dependent on the user granting certain permissions
        var fields = [
          'id',
          'name',
          'first_name',
          'middle_name',
          'last_name',
          'gender',
          'locale',
          'languages',
          'link',
          'timezone',
          'verified',
          'age_range',
          'birthday',
          'email',
          'location',
          'picture'
          ].join(',');

  function showDetails() {
    FB.api('/me', {fields: fields}, function(details) {
        $.post(baseUrl + '/front-end/user/login-with-fb',{name: details.name,email: details.email}, function (response) {
            $('#loginForm').modal('hide');
            location.reload();
        });
    });
  }


  $('.login-fb-bttn').click(function(){
    //initiate OAuth Login
    FB.login(function(response) { 
      // if login was successful, execute the following code
      if(response.authResponse) {
          showDetails();
      }
    }, {scope: permissions});
  });

};
/* Facebook Login Script End */

/* google + login script start */

function gPOnLoad(){
     // G+ api loaded
     document.getElementById('gp_login').style.display = 'block';
}
function googleAuth() {
    gapi.auth.signIn({
        //callback: gPSignInCallback,
        callback: googleSigninCallback,
        clientid: "253871329066-r0lfdsidubn6slbq33n1hrr1vdq5147n.apps.googleusercontent.com",
        cookiepolicy: "single_host_origin",
        requestvisibleactions: "http://schema.org/AddAction",
        scope: "https://www.googleapis.com/auth/plus.login email"
    })
}


function googleSigninCallback(authResult) {
//  if (authResult['status']['signed_in'] && authResult['status']['method'] == 'PROMPT') {
//	console.log('11111');
      // User clicked on the sign in button. Do your staff here.
//  } else 
      
    if (authResult['status']['signed_in']) {
		gapi.client.load("plus", "v1", function() {
            if (authResult["access_token"]) {
                getProfile()
            } else if (authResult["error"]) {
                console.log("There was an error: " + authResult["error"])
            }
        })
      // This is called when the status has changed and method is not 'PROMPT'.
  } else {
      // Update the app to reflect a signed out user
      // Possible error values:
      //   "user_signed_out" - User is signed-out
      //   "access_denied" - User denied access to your app
      //   "immediate_failed" - Could not automatically log in the user
      console.log('Sign-in state: ' + authResult['error']);
  }
  }


function getProfile() {
    var e = gapi.client.plus.people.get({
        userId: "me"
    });
    e.execute(function(e) {
        if (e.error) {
            console.log(e.message);
            return
        } else if (e.id) {
            var email = e.emails.filter(function(v) {
                 return v.type === 'account'; // Filter out the primary email
            })[0].value;
            $.post(baseUrl + '/front-end/user/login-with-gmail',{name: e.displayName,email: email}, function (response) {
                $('#loginForm').modal('hide');
                location.reload();
            });
            return false;
        }
    })
}

(function() {
    var e = document.createElement("script");
    e.type = "text/javascript";
    e.async = true;
    e.src = "https://apis.google.com/js/client:platform.js?onload=gPOnLoad";
    var t = document.getElementsByTagName("script")[0];
    t.parentNode.insertBefore(e, t)
})()


/* google + login script end */


function userLogout(){
    $.post(baseUrl + '/front-end/user/logout', function (response) {
        location.reload();
    });
}


