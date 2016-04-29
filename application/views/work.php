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
                
                
                
                <?php if(!$ideas): ?>
                
                <?php else: ?>
           <?php foreach($ideas as $idea): ?>
              <!-- AN IDEA -->
                <div class="an-idea-by-two float-left an-idea">    
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

                        <span class="author-name simple-themed">
                            <h3>Team :  <?php
                        foreach($ongoing as $item){
                            if($item['ideaid'] == $idea->idea_id){
                                echo $item['users'];
                                $timeline = $item['timeline'];
                                break;
                            }
                        }
                        ?></h3>
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
                   $('.an-idea-overlay').on('click' , function(e){
                       e.preventDefault();
                   });
            </script>
