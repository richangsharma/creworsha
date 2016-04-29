<?php
/*If user is already logged in, show his profile page here :D :D :D redirect user to this login screen if he is not logged in
and trying to access /login url.
 * If user is logged in and trying to access /user/login ; redirect him to /login(ie profile page).
*/

?>







            <div id='login-wrapper' class="gap-top-large">
                <div class='float-left by-two'>
                    <div class="login-greeter center" id="init-login" title="LOGIN">
                        <img src="<?php echo ASSETS.'images/login-static.jpg'; ?>" />
                    </div>
                </div>
                
                
                
                <div class='float-right by-two' title="REGISTER">
                    <div class="login-greeter center" id="init-register">
                        <img src="<?php echo ASSETS.'images/register-static.jpg'; ?>" />
                    </div>
                </div>
            
            </div>
            <!-- END FEATURED -->
            

            

            <!-- A SEPARATOR -->
            <div class='bg-gap'>
            </div>
            <!-- END SEPARATOR -->
            <script>
            $(document).on("submit","#reg-form",function(e){
                e.preventDefault();
                var ele = $('#reg-form');
                var data = $('#reg-form').serialize();
                console.log(data);
                var url = ele.attr('action');
                $.ajax({
                   data : data,
                   url : url,
                   method: 'POST',
                   
                }).done(function(getdata){
                    if(getdata != 1){
                     //$('#registration-errors').html(getdata);
                     var getdata = JSON.parse(getdata);
                     var count = getdata.length;
                     console.log(count);
                     $('.reg-error').html('');
                     for(i=0;i<count;i++){
                      console.log(getdata[i]);
                      switch(getdata[i]){
                         case 'un':
                             var tar = $('#reg-un-error');
                             var usrn = $('#reg-un').val();
                             if(usrn.length > 10){
                                 usrn = 'Username';
                             }
                             $('#reg-un-error').html('<span>So sorry dear, <strong>'+ usrn +' </strong>is not valid.Please try another.</span>');
                             break;
                         case 'fn':
                             var tar = $('#reg-fnln-error');
                             $('#reg-fnln-error').html('<span>Your full name is not valid</span>');
                             break;
                         case 'ln':
                             var tar = $('#reg-fnln-error');
                             $('#reg-fnln-error').html('<span>Your full name is not valid</span>');
                             break;
                         case 'em':
                             var tar = $('#reg-em-error');
                             $('#reg-em-error').html('<span>We are pretty sure that this is not your email.</span>');
                             break;
                         case 'pwd':
                             var tar = $('#reg-pwd-error');
                             $('#reg-pwd-error').html('<span>World is not good enough.At least 6 chars are required.</span>');
                             break;
                         case 'cpwd':
                             var tar = $('#reg-cpwd-error');
                             $('#reg-cpwd-error').html('<span>Double check the password! They don&apos;t match.</span>');
                             break;
                         
                        }
                     }
                     
                    }
                    if(getdata == 1){
                    //means success,redirect to success page
                    var name = $('#reg-fn').val() + " " + $('#reg-ln').val();
                    var email = $('#reg-em').val();
                        window.open("<?php echo SITEURL; ?>user/success?name="+name+"&email="+email,"_self")
                    }
                    if(getdata == 500){
                        //mega server error
                    }
                });
            });
            
            $(document).on("submit","#lg-form",function(e){
                e.preventDefault();
                $('#login-status').html('<img src="<?php echo ASSETS; ?>images/login-load.gif" />');
                var ele = $('#lg-form');
                var data = $('#lg-form').serialize();
                console.log(data);
                var url = ele.attr('action');
                $.ajax({
                   data : data,
                   url : url,
                   method: 'POST',
                   
                }).done(function(getdata){
                    if(getdata == 1){
                        //successful logged in
                     $('#login-status').html('Wohoo...Taking you to skies !');
                     window.location = "<?php echo SITEURL; ?>user/quickstart";
                    }else{
                     //login failed    
                     $('#login-status').html('Login Failed.Please retry.');
                    }
                });
            });
            </script>
            
            
            
            
            
            