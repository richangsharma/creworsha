$(document).on('ready',function(){
   $('#init-login').on('click',function(){
    
       
      /*
       * Kick register out of view ****************
       */
      var currentmar = parseInt($('#login-wrapper').css('width'));
      var currentmar = currentmar/11.3;
      $(this).css({'margin-left' : currentmar});
      var elemfade = $(this);
    $({deg: currentmar}).animate({deg: 700}, {
        duration: 2210,
        step: function(now){
            elemfade.css({
                'margin-left' : now
            });
        }
    });
    //For other element
    var currentmar2 = parseInt($('#login-wrapper').css('width'));
      var currentmar2 = currentmar2/11.3;
      $('#init-register').css({'margin-left' : currentmar2});
      var elemfade2 = $('#init-register');
    $({deg: currentmar2}).animate({deg: 900}, {
        duration: 3000,
        step: function(now2){
            elemfade2.css({
                'margin-left' : now2
            });
        },
        complete: function(){
            //Animation complete.Load div
            $('#login-wrapper').append("<div id='login-form'><img src='http://localhost/creworsha/assets/images/loading.gif' /><span class='bold-white'>LOADING FORM</span><hr/></div>");
            $('#login-form').load('http://localhost/creworsha/ajax/login-form.php');
        }
    });
    /*
       * END Kick register out of view ****************
       */
    
    
   });
   
   
   
   $('#init-register').on('click',function(){
    
       
      /*
       * Kick register out of view ****************
       */
      var currentmar = parseInt($('#login-wrapper').css('width'));
      var currentmar = currentmar/11.3;
      $('#init-login').css({'margin-left' : currentmar});
      var elemfade = $('#init-login');
    $({deg: currentmar}).animate({deg: -700}, {
        duration: 3200,
        step: function(now){
            elemfade.css({
                'margin-left' : now
            });
        }
    });
    //For other element
    var currentmar2 = parseInt($('#login-wrapper').css('width'));
      var currentmar2 = currentmar2/11.3;
      $('#init-register').css({'margin-left' : currentmar2});
      var elemfade2 = $('#init-register');
    $({deg: currentmar2}).animate({deg: -620}, {
        duration: 2210,
        step: function(now2){
            elemfade2.css({
                'margin-left' : now2
            });
        },
        complete: function(){
            //Animation complete.Load div
            $('#login-wrapper').append("<div id='registration-form'><img src='http://localhost/creworsha/assets/images/loading.gif' /><span class='bold-white'>LOADING FORM</span><hr/></div>");
            $('#registration-form').load('http://localhost/creworsha/ajax/registration-form.php');
        }
    });
    /*
       * END Kick register out of view ****************
       */
    
   });
   
   
   /*HOVER/LEAVE FUNCTIONS FOR CONTROLLING GIF ANIMATION */
   $('#init-register').on('mouseenter',function(){
       var elereg = $(this).find('img');
       elereg.attr('src' , 'http://localhost/creworsha/assets/images/register.gif');
   });
   $('#init-register').on('mouseleave',function(){
       var elereg = $(this).find('img');
       elereg.attr('src' , 'http://localhost/creworsha/assets/images/register-static.jpg');
   });
   
   
   
   $('#init-login').on('mouseenter',function(){
       var elereg = $(this).find('img');
       elereg.attr('src' , 'http://localhost/creworsha/assets/images/login.gif');
   });
   $('#init-login').on('mouseleave',function(){
       var elereg = $(this).find('img');
       elereg.attr('src' , 'http://localhost/creworsha/assets/images/login-static.jpg');
   });
   
   
/*
* ANIMATION FOR SLIDER
 */
sliderpos = 0;
     nextslide = function (){
         var currentmar = $('#wizard-slider-wrapper').css('margin-left');
                    if((0-(parseInt(currentmar))) < (1920)){
                   $('#wizard-slider-wrapper').animate({'margin-left':'+=-960px'} ,1200);
                   sliderpos = sliderpos+1;
                    }else{
                        return false;
                    }
     }
     prevslide = function(){
         var currentmar = $('#wizard-slider-wrapper').css('margin-left');
                    if(parseInt(currentmar) != 0){
                   $('#wizard-slider-wrapper').animate({'margin-left':'+=960px'} ,1200);
                   sliderpos = sliderpos-1;
                    }else{
                        return false;
                    }
     }
     incwiz = function(){
         $('.idea-wizard-progress-bar-ind').animate({'width':'+=138px'},1200);
     }
     decwiz = function(){
         $('.idea-wizard-progress-bar-ind').animate({'width':'-=138px'},1200);
     }
     authentry = function(what){
         switch (sliderpos){
             case 0:
                 iput = $('#idea-title').val();
                 if((iput.length > 20) || (iput.length < 6)){
                     $('.error-wizard').jGrowl("<div id='stella-error'><img src='http://localhost/creworsha/assets/stella/worry.png' class='float-left' /><span class='float-right'>Please ensure that the title is at leaset 6 character long</span></div>" , {header:'Ouch !' ,sticky : false , theme:'stella-error' , closeTemplate : ''});
                 }else{
                     return 1;
                 }
                 break;
             case 1:
                 desc = $('#idea-desc').val();
                 console.log(desc);
                 if((desc.length > 200) || (desc.length < 20)){
                     $('.error-wizard').jGrowl("<div id='sherman-error'><img src='http://localhost/creworsha/assets/sherman/tease.png' class='float-left' /></div>" , {header:'Something is wrong with the description(6 to 200 chars only)' ,sticky : false , theme:'stella-error' , closeTemplate : '' , pool : 1 , closer : false});
                 }else{
                     return 1;
                 }
                 break;
         }
     }
                $('#wizard-slider-control-next').on('click', function(){
                    if(authentry(sliderpos) == 1){
                    nextslide();
                    incwiz();
                    $('.idea-title').html($('#idea-title').val());
                    }else{
                    return false;
                    }
                });
                $(document).keydown(function(e){
                if (e.keyCode == 37) {
                    prevslide();
                    decwiz();
                }
                if (e.keyCode == 39) { 
                if(authentry(sliderpos) == 1){
                    nextslide();
                    incwiz();
                    $('.idea-title').html($('#idea-title').val());
                    }else{
                    $('.error-wizard').jGrowl("<div id='stella-error'><img src='http://localhost/creworsha/assets/stella/worry.png' class='float-left' /><span class='float-right'>Please ensure that the title is at leaset 6 character long</span></div>" , {header:'Ouch !' ,sticky : false , theme:'stella-error' , closeTemplate : ''});
                    }
                }
                });
                $('#wizard-slider-control-prev').on('click', function(){
                   prevslide();
                   decwiz();
                });
 
 
 
 
 /*
  * 
  * FOR OTHER SLIDER
  */
 $('#slider-control-next').on('click', function(){
                    nextslide();
                });
                $(document).keydown(function(e){
                if (e.keyCode == 37) {
                    prevslide();
                }
                if (e.keyCode == 39) { 
                
                    nextslide();
                }
                });
                $('#slider-control-prev').on('click', function(){
                   prevslide();
                });
 
 
 /*
 * END ANIMATION FOR SLIDER
  */
 
 
});
