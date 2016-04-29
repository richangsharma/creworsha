<!-- FEATURED -->
<h1 class="center ideas-page simple-themed">ideas</h1>
<h3 class="center ideas-page-sub simple-themed">Ideas can be life-changing. Sometimes all you need to open the door is just one more good idea.....
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
                
                
                <!-- AN IDEA -->
                <div class="an-idea-by-two float-left an-idea">
                    <a href="<?php echo SITEURL; ?>ideas/add" title="Add New Idea">
                    <div class="an-idea-overlay">
                         <img src="<?php echo ASSETS; ?>icons/core/32px/plus.png" width="300" height="300"/>
                    </div>
                    </a>
                    <div class="idea-image" style="height:360px">
                    <img src="http://localhost/creworsha/assets/images/success.gif" width="455px" height="360px"/> 
                    </div>

                    <div class="idea-title">

                    </div>

                    
                </div>
              <!-- END AN IDEA -->
                
                
                
                <?php if(!$ideas): ?>
                
                <?php else: ?>
           <?php foreach($ideas as $idea): ?>
              <!-- AN IDEA -->
                <div class="an-idea-by-two float-left an-idea">

                    <div class="an-idea-overlay" data="<?php echo SITEURL.'ideas/view?id='.$idea->idea_id; ?>">
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
                        <span><img src="<?php echo ASSETS; ?>images/c1.png" align="middle"/></span>

                        <span class="author-name simple-themed"><?php echo $idea->name; ?></span>

                        <span class="idea-likes">
                        <ul>
                            <li><img src="<?php echo ASSETS; ?>icons/core/16px/star2.png"/></li>
                            <li><img src="<?php echo ASSETS; ?>icons/core/16px/star2.png"/></li>
                            <li><img src="<?php echo ASSETS; ?>icons/core/16px/star2.png"/></li>
                            <li><img src="<?php echo ASSETS; ?>icons/core/16px/star2.png"/></li>
                            <li><img src="<?php echo ASSETS; ?>icons/core/16px/star2.png"/></li>
                        </ul>
                        </span>

                    </div>


                    <div class="idea-desc">
                        <p><?php echo $idea->idea_desc; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
              <!-- END AN IDEA -->
                <?php endif; ?>
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
