<?php include('variables.php'); ?>
<link rel="stylesheet" href="<?php echo ASSETS; ?>upload/css/bootstrap.min.css">
<!-- Generic page styles -->

<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo ASSETS; ?>upload/css/jquery.fileupload.css">

<div id='login-wrapper' class="gap-top-large">
    <div id="idea-wizard-progress" class="center">
        <ul>
            <li><img src="<?php echo ASSETS ?>icons/wizard-one.png"/></li><div class="idea-wizard-progress-bar"><div class="idea-wizard-progress-bar-ind"></div></div>
            <li><img src="<?php echo ASSETS ?>icons/wizard-two.png"/></li><div class="idea-wizard-progress-bar"></div>
            <li><img src="<?php echo ASSETS ?>icons/wizard-three.png"/></li>
        </ul>
    </div>
    <div id="msg-welcome"></div>
    <div id='wizard-slider'>
        <span id='wizard-slider-control-next' class='wizard-slider-nav-next'>&nbsp; </span>
        <span id='wizard-slider-control-prev' class='wizard-slider-nav-prev'>&nbsp;</span>
        <div id='wizard-slider-wrapper'>
        <div id='wizard-slide1' class='wizard-aslide'>
            
            <div >
                <div class=" float-left">
                    <blockquote class='oval-speech float-left'>
                        <p>Hi <?php echo $name; ?>! , it's  so good to see you again. Please set title for your super awesome idea ! Let's choose a title that will reflect the thought at first glance. Keep it short and clear.</p>
                    </blockquote>
                    <div><img src='http://localhost/creworsha/assets/stella/amazed.png' /></div>
                </div>
                <div class="error-wizard"></div>
                <input type='text' name='idea-title' placeholder='Idea Title' id='idea-title' />
                <div class=" float-right">
                    <blockquote class='oval-thought float-right'>
                         <p>I remember someone named idea of creating time machine to toaster. Toaster ? seriously ? Nobody viewed his idea and  here we are, without time machine. </p>
                    </blockquote>
                    <div id="stella-thinking-wizard"><img src='<?php echo ASSETS; ?>stella/thinking.png' /></div>
                </div>
                
            </div>
            
            
        </div>
        <div id='wizard-slide2' class='wizard-aslide'>
            
            
            <div >
                <div class=" float-left">
                    <blockquote class='oval-speech float-left'>
                        <span class="idea-title"></span> sounds like a great title <?php echo $name; ?>. It's time to get a little more detail on the idea. Please describe your idea so that it explains it but be sure not to give too much detail that the idea could be stolen. 
                    </blockquote>
                    <div><img src='http://localhost/creworsha/assets/sherman/hi.png' /></div>
                </div>
                <div class="error-wizard"></div>
                <textarea name='idea-desc' placeholder='Your Super Amazing Idea Title' id='idea-desc'></textarea>
                <div class=" float-right">
                    <blockquote class='oval-thought float-right'>
                         <p>Thanks for reminding about the Time Machine guy Stella. <?php echo $name; ?> you won't believe it but I actually met that guy, he is amazing but too lazy to work on any idea. Maybe you can talk him into working on TM again ? </p>
                    </blockquote>
                    <div id="stella-thinking-wizard"><img src='<?php echo ASSETS; ?>sherman/thinking.png' /></div>
                </div>
                
            </div>
            
        </div>
            <div id='wizard-slide3' class='wizard-aslide'>
                <div class=" float-left">
                    <blockquote class='oval-speech float-left'>
                        <p>Wooohooo !! Last step . Please add images or other stuff that will able to demonstrate the idea in detail. We don't want  to end up like the Time Machine guy. Correct <?php echo $name; ?> ? </p>
                    </blockquote>
                    <div><img src='http://localhost/creworsha/assets/stella/joy.png' /></div>
                </div>
                <?php include('ajax-upload.php'); ?>
                <a href='#' id='submitidea'>SUBMIT IDEA</a>
            </div>
        </div>
    </div>
</div>
<!--<div id='wizard-slider-control' class='center'>
    <span id='wizard-slider-control-prev' class='wizard-slider-nav-prev float-left'>&nbsp;<</span>
    <span id='wizard-slider-control-next' class='wizard-slider-nav-next float-right'>&nbsp;></span>
</div>-->

            
            <!-- END FEATURED -->
            <!-- A SEPARATOR -->
            <div class='bg-gap'>
            </div>
            <!-- END SEPARATOR -->
            <script>
                (function($){
			$(window).load(function(){
				$(".form-actual").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
			});
		})(jQuery);
                
                
                /*
                 * SUBMIT THE IDEA
                 */
                response = 0;
                submitidea = function(){
                //Prepare variables to be sent 
                var title = $('#idea-title').val();
                var desc = $('#idea-desc').val();
                var url = "<?php echo SITEURL; ?>ideas/add_do";
                $.ajax({
                    url : url,
                    method : 'POST',
                    data : {title : title , desc : desc}
                }).done(function(data){
                    console.log(data);
                    if(data == 1){
                        //redirect to somewhere 
                     alert('idea submitted successfully');
                     //hide uploading screen now.And remove the main div containing the slider
                     $('#login-wrapper').append("<div id='uploading-success'><div id='uploading-content'><p><img src='<?php echo ASSETS; ?>stella/success.png' /></p><p>Congratulations <?php echo $name; ?>,Idea Submitted Successfully.</p><a class='success-but'>VIEW IDEAS</a></div></div>");
                       //remove form
                        $('#idea-wizard-progress').remove();
                        $('#uploading-status').remove();
                        $('#wizard-slider').remove();
                    }else{
                        //hide uploading screen and show error message
                     $('#login-wrapper').append("<div id='uploading-status'><div id='uploading-content'><p><img src='<?php echo ASSETS; ?>stella/error.png' /></p><p>Sorry <?php echo $name; ?><p>An error occured</p></p></div></div>");
                     $('#uploading-status').hide();
                    }
                    
                });
                return response;
                        }
                        $(document).on('click' ,'#submitidea' , function(e){
                        e.preventDefault();
                        console.log('clicked on the submit area');
                        $('#login-wrapper').append("<div id='uploading-status'><div id='uploading-content'><p><img src='<?php echo ASSETS; ?>stella/work.png' /></p><p>Uploading Your Idea.Please Wait.</p></div></div>");
                        //show the uploading screen
                        submitidea();
                        });
            </script>
