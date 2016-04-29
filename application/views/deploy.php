<?php include('slider-idea.php'); ?>	
<div id='view-idea-wrapper' class="gap-top-large">
<center><p><img src='http://localhost/creworsha/assets/stella/success.png' /></p><p>Congratulations <?php echo $this->session->userdata('name'); ?>,Work has been published.</p><a class='success-but' href="<?php echo SITEURL; ?>work" style="color:#ffffff">VIEW WORKS</a>
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
