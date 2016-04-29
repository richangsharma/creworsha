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
        
        <div class="idea-desc gap-top-large">
            <?php echo $desc; ?>
        </div>
    </div>
    <hr class="gap-top-large"/>
    <h3>Idea Files: </h3>
    <div class="idea-files-list">
        <ul>
            <?php foreach($files as $file): ?>
            <li><a href="http://localhost/creworsha/ideabox/<?php echo $id; ?>/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a></li>
          <?php endforeach; ?>
        </ul>
    </div>
    <hr/>
    <div id="connect-form">
    <?php 
    if($userid = $thought->user_id != $this->session->userdata('id')): ?>
        <?php if($request_response == -1):?>
    <h3>Join <?php echo $name; ?>'s Idea</h3>
    <form id="idea-con-form">
        <p><textarea placeholder="Custom message for <?php echo $name; ?>" id="message" required></textarea></p>
        <p><input type='submit' value="Connect with <?php echo $name; ?>'s idea !!" required/></p>
    </form>
        <?php endif; ?>
    
        <?php if($request_response == 1): ?>
    <h1><?php echo $name; ?> has accepted your idea. Here's what we have planned.</h1>
    <div>
        Plan
    </div>
            <form id="idea-con-form">
        <p><input type='submit' value="" required/></p>
    </form>
        <?php endif; ?>
    
    
        <?php if($request_response == 2): ?>
    <h3><?php echo $name; ?> has denied your request. Good news is you can always retry.</h3>
    <form id="idea-con-form">
        <p><textarea placeholder="Custom message for <?php echo $name; ?>" id="message" required></textarea></p>
        <p><input type='submit' value="Connect with <?php echo $name; ?>'s idea !!" required/></p>
    </form>
        <?php endif; ?>
    
        <?php if($request_response == 0): ?>
            Request Already Send,Waiting For <?php echo $name; ?>'s Reply.
        <?php endif; ?>
    <?php endif; ?>
    </div>
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
