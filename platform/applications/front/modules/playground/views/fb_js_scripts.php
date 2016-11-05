<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <script type="text/javascript">
    //<![CDATA[

        // Initiate Facebook JS SDK
        window.fbAsyncInit = function() {
            FB.init({
                appId   : '<?php echo $this->config->item('facebook_app_id'); ?>', // Your app id
                cookie  : true,  // enable cookies to allow the server to access the session
                xfbml   : false,  // disable xfbml improves the page load time
                version : 'v2.5',
                status  : true // Check for user login status right away
            });

            FB.getLoginStatus(function(response) {
                console.log('getLoginStatus', response);
                loginCheck(response);
            });
        };

        // Check login status
        function statusCheck(response)
        {
            console.log('statusCheck', response.status);
            if (response.status === 'connected')
            {
                $('.login').hide();
                $('.form').fadeIn();
            }
            else if (response.status === 'not_authorized')
            {
                // User logged into facebook, but not to our app.
            }
            else
            {
                // User not logged into Facebook.
            }
        }

        // Get login status
        function loginCheck()
        {
            FB.getLoginStatus(function(response) {
                console.log('loginCheck', response);
                statusCheck(response);
            });
        }

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function getUser()
        {
            FB.api('/me', function(response) {
                console.log('getUser', response);
            });
        }

        $(function(){
            // Trigger login
            $('.login').on('click', 'button', function() {
                FB.login(function(){
                    loginCheck();
                }, {scope: '<?php echo implode(",", $this->config->item('facebook_permissions')); ?>'});
            });

            $('.form').on('submit', '.post-to-wall', function(e) {
                e.preventDefault();

                var formdata = $(this).serialize();

                $.ajax({
                    url: '/example/post',
                    data: formdata,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.id)
                        {
                            $('.form').html('<p>Post submitted successfully.</p>');
                        }
                        else
                        {
                            $('.form').html('<p>Something happened, please try again!.</p>');
                        }
                    }

                })
            });
        });

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    //]]>
    </script>
