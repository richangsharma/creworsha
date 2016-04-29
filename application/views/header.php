<?php
$id = $this->session->userdata('id');
if(isset($id) && $id != ''){
    $user = TRUE;
    //include the variables file
    include('variables.php');
}else{
    $user = FALSE;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            @import url('<?php echo ASSETS; ?>css/style.css');
            @import url('<?php echo ASSETS; ?>css/jquery.jgrowl.css');
            @import url('<?php echo ASSETS; ?>css/jquery.mCustomScrollbar.css');
        </style>
        <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
        <script src="<?php echo ASSETS; ?>js/jquery-ui.min.js"></script>
        <script src="<?php echo ASSETS; ?>js/jquery.jgrowl.js"></script>
        <script src="<?php echo ASSETS; ?>js/animations.js"></script>
        <script src="<?php echo ASSETS; ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
         
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo ASSETS; ?>upload/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo ASSETS; ?>upload/js/load-image.min.js"></script>
<script src="<?php echo ASSETS; ?>upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo ASSETS; ?>upload/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="<?php echo ASSETS; ?>upload/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo ASSETS; ?>upload/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="<?php echo ASSETS; ?>upload/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="<?php echo ASSETS; ?>upload/js/cors/jquery.xdr-transport.js"></script>
<![endif]-->

        <title><?php echo $title; ?></title>
    </head>
    <body>
        
        <div id="wrapper"><!-- WRAPS EVERYTHING IN 960px -->
            <!-- START HEADER -->
            <header><br/>
                <div class='float-left'>
                    <div id='logo' class='float-left'>
                        <!-- <img src='<?php echo ASSETS; ?>images/logo.png' alt='Creworsha Logo'/> -->
                        CREWORSHA
                    </div>
                    <div class='float-left bar'>
                        &nbsp;
                    </div>
                    <div id='navigation' class='float-left'>
                        <nav>
                            <ul>
                                <li>
                                    <a href='<?php echo SITEURL; ?>' title='Goto Home' class='simple-white'>Home</a>
                                </li>
                                <li>
                                    <a href='<?php echo SITEURL; ?>ideas' title='Goto Home' class='simple-white'>Ideas</a>
                                </li>
                                <li>
                                    <a href='<?php echo SITEURL; ?>ongoing' title='Goto Home' class='simple-white'>Ongoing</a>
                                </li>
                                <li>
                                    <a href='<?php echo SITEURL; ?>work' title='Goto Home' class='simple-white'>Work</a>
                                </li>
                                <li>
                                    <!-- <a href='#' title='Goto Home' class='simple-white'>Contact</a> -->
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <?php if($user): ?>
                <div class='float-right'>
                    <div class='float-right'>
                        <a href='<?php echo SITEURL; ?>user/logout' class='simple-white-thin'>
                        <div class='button-type-a simple-white-thin'>
                            Logout
                        </div>
                         </a>
                    </div>
                    <div class='float-right gap-right'>
                        <div class='gutter'>
                            <span class='simple-white-thin'>Howdy, </span><span class='simple-themed-thin' id='user-name'><?php echo $name; ?><span id="notification-bubble">0</span></span>
                        </div>
                        
                    </div>
                </div>
                
                
                <!-- NONSENSE CODE FOR PANEL -->
                
                <script>
                    $(document).ready(function(){
 /*
  * HEADER PUSH PANEL
  */
 
 $('#user-name').on('click',function(){
    $('#push-pane').animate({'height':'200px'});
 });
 
//Ajax for checking if there is any new notification
notif = function(){
    $.ajax({
        url : 'http://localhost/creworsha/index.php/user/get_message',
        method : 'GET'
    }).done(function(data){
        data = JSON.parse(data);
        len = data.length;
        if(data == 0){
        $('#notification-bubble').html('0');
        }else{
        $('#notification-bubble').html(len);    
        }
        $('#notification').html('');
        for(i=0;i<len;i++){
            $('#notification').append('<div class="anotification">'+ data[i]['sendername'] +' ask to join your project <a href="http://localhost/creworsha/index.php/ideas/view?id='+ data[i]['id'] + '" target="_blank#connect-form">' + data[i]['ideaname'] +'</a> <button class="notif-button" usrid = "'+ data[i]['sentfrom'] +' " data="'+data[i]['message']+'" msg_id="'+ data[i]['msg_id'] +'" name="'+ data[i]['sendername'] +'"><img src="http://localhost/creworsha/assets/icons/core/16px/expand.png" /></button></div>');
        }
        
    });
       
    
}
    setInterval(notif , 2000);
    $(document).on('click','.notif-button',function(){
        $('.notif-popup').jGrowl("<div id='stella-msg'><img src='http://localhost/creworsha/assets/stella/super.png' class='float-left' /><span class='float-right' style='background:#ffffff;color:#000000;'>"+ $(this).attr('name')+" said, "+$(this).attr('data') +"</span><p><button id='but_accept'>Accept</button> <button id='but_deny'>Deny</button></p></div>" , {header:'' ,sticky : true , theme:'stella-msg' , closeTemplate : '<img src="http://localhost/creworsha/assets/icons/core/16px/close.png"/>'});
    });
    
    $(document).on('click','#but_accept',function(){
        index = $(this).index();
         msg_id = $('.notif-button').eq(index).attr('msg_id');
         ref = $('.notif-button').eq(index).attr('usrid');
        window.location = "<?php echo SITEURL; ?>user/connect?userid="+ ref +"&msgid="+ msg_id;  
    });
 /*
  *
  * 
  * END HEADER PUSH PANEL
  */
 });
 
                </script>
                <!-- END NONSENSE CODE -->
                <?php else: ?>
                
                
                <div class='float-right'>
                    <div class='float-right'>
                        <a href='<?php echo SITEURL; ?>user/login' class='simple-white-thin'>
                        <div class='button-type-a simple-white-thin'>
                            Sign In
                        </div>
                         </a>
                    </div>
                    
                </div>
                <?php endif; ?>
            </header>
            <!-- HEADER ENDS -->
            <div id='push-pane'>
                <!-- CONTAIN ALERT -->
                <div class="notif-popup"></div>
                <!-- END ALERT -->
                <div id="notification" data="id">
                </div>
            </div>
