<?php include('slider-idea.php'); ?>	
<div id='view-idea-wrapper' class="gap-top-large">
                <div class="box_skitter idea-slider">
                                        <ul>
                            <?php foreach($idea as $thought): ?>
                            <?php $images = explode(',',$thought->idea_thumbs);
                            $desc = $thought->idea_desc;
                            $title = $thought->idea_title;
                            $files = explode(',',$thought->idea_files);
                            $name = $thought->name;
                            $id = $thought->idea_id;
                            $userid = $thought->user_id;
                            $time = $thought->idea_post_time;
                            ?>
                                <?php foreach($images as $image): ?>
                                        <li><img src="http://localhost/creworsha/ideabox/<?php echo $thought->idea_id; ?>/<?php echo $image; ?>" width="960px" height="200px" alt="" /><div class="label_text"><p></p></div></li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                                        </ul>
                </div>
    <div class="view-idea">
        <h2><?php echo $title; ?></h2>
        <h4>an idea by  <?php echo $name; ?></h4>
        <h3>Team :  <?php
                        foreach($ongoing as $item){
                            if($item['ideaid'] == $id){
                                echo $item['users'];
                                $timeline = $item['timeline'];
                            }
                        }
                        ?></h3>
        <h3>
            TIMELINE : <?php echo $timeline; ?>
        </h3>
        <div class="idea-desc gap-top-large">
            <?php echo $desc; ?>
        </div>
    </div>
    <hr class="gap-top-large"/>
    <h3>Project  Files: </h3>
    <div class="idea-files-list">
        <ul>
            <?php foreach($files as $file): ?>
            <li><a href="http://localhost/creworsha/ideabox/<?php echo $id; ?>/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a></li>
          <?php endforeach; ?>
        </ul>
    </div>
    <hr/>
    <center>
        <a href="<?php echo SITEURL; ?>ongoing/deploy?id=<?php echo $id; ?>">
    <div id="deploy">
        DEPLOY
    </div>
            </a>
        </center>
</div>
    <script>
        $(document).on('ready',function(){
           $('#idea-con-form').on('submit' , function(e){
               var url = "<?php echo SITEURL; ?>ideas/connect";
               e.preventDefault();
               $.ajax({
                   url : url,
                   data : {message : $('#message').val() , idea : '<?php echo $id; ?>', ideaname: '<?php echo $title; ?>'},
                   method : 'POST'
               }).done(function(data){
                   $('#connect-form').html('<h1>Request Sent. Waiting For Reply</h1>');
               });
           });
        });
    </script>
