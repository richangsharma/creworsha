<?php
/*print_r($ongoing);
die();
*/
?><!-- FEATURED -->
<h1 class="center ideas-page simple-themed">Ongoing</h1>
<h3 class="center ideas-page-sub simple-themed">These are the projects which are being worked on.
</h3>
<div class="gap-top-large"></div>
            <div id='idea-browser' class="gap-top-large center">
                <!-- <div id="ideas-sort">
                    <ul>
                        <li class="selected" ><a href="#">Recent</a></li>
                        <li><a href="#">Top Rated</a></li>
                        <li><a href="#">Featured</a></li>
                    </ul>
                </div> -->
                <?php if(!$ideas): ?>
                <center><h1>NOTHING IS BEING WORKED ON </h1></center>
                <?php else: ?>
           <?php foreach($ideas as $idea): ?>
              <!-- AN IDEA -->
                <div class="an-idea-by-two float-left an-idea">

                    <div class="an-idea-overlay" data="<?php echo SITEURL.'ongoing/view?id='.$idea->idea_id; ?>">
                         <img src="<?php echo ASSETS; ?>icons/core/open-link.png" width="300" height="300"/>
                    </div>

                    <div class="idea-image">
                         <?php
                         //break string to array
                         $images = explode(',',$idea->idea_thumbs);
                         ?>
                    <img src="http://localhost/creworsha/ideabox/<?php echo $idea->idea_id; ?>/<?php echo $images[0]; ?>" width="455px" height="360px"/> 

                    </div>

                    <div class="idea-title">

                        <p><?php echo $idea->idea_title; ?></p>

                    </div>

                    <div class="author-info">

                        <span class="author-name simple-themed">Team : <?php
                        foreach($ongoing as $item){
                            if($item['ideaid'] == $idea->idea_id){
                                echo $item['users'];
                            }
                        }
                        ?></span>
                    </div>


                    <div class="idea-desc">
                        <p><?php echo $idea->idea_desc; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
              <?php endif; ?>
              <!-- END AN IDEA -->
                
            </div>
          
            
            <!-- END FEATURED -->
            
            <!-- A SEPARATOR -->
            <div class='bg-gap'>
            </div>
            <!-- END SEPARATOR -->
            <script>
                $('.an-idea-overlay').hide();
                $(document).on('ready', function(){
                   $('.an-idea').on('mouseenter' , function(){
                      $(this).find('.an-idea-overlay').fadeIn();
                   });
                   $('.an-idea').on('mouseleave' , function(){
                      $(this).find('.an-idea-overlay').fadeOut();
                   });
                   $('.an-idea-overlay').on('click' , function(){
                      var url = $(this).attr('data');
                      location.href = url;
                      console.log(url);
                   });
                });
            </script>
