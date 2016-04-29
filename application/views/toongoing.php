<?php 
foreach($idea as $item){
    $sender = $item->sendername;
    $senderid = $item->sentfrom;
    $message = $item->message;
    $messageid = $item->msg_id;
    $idea = $item->ideaname;
    $ideaid = $item->id;
    $time = $item->time;
}
?>

<!-- LOAD ASSETS -->
        <style>
            @import url('<?php echo ASSETS; ?>date/css/datepicker.css');
            </style>
            <script src="<?php echo ASSETS; ?>date/js/datepicker.js"></script>
            <script src="<?php echo ASSETS; ?>date/js/eye.js"></script>
            <script src="<?php echo ASSETS; ?>date/js/layout.js"></script>
            <script src="<?php echo ASSETS; ?>date/js/utils.js"></script>
<style>
    #list-user li{
        list-style: none;
        text-justify: inter-word;
    }
</style>
<!--  / LOAD ASSETS -->
<div id='login-wrapper' class="gap-top-large">
                <center>
                    <h1>
                        Let's Get Rolling 
                    </h1>
                </center>
                 Hello <?php echo $this->session->userdata('name'); ?>, It's wonderful to start a new work on idea, let's work together to create new stuff :D.
                 <p>You are working on <strong><?php echo $idea; ?></strong>,we wish you all the very best for this project. Now before we start, we need you to define a time line. Please select start and end date of your project below. First click on start date then select end date for your project timeline, add extra info if you want and hit begin !</p>
                 <p>
                 <center>
                     <h3>TimeLine</h3>
                     <form id="ongoing-form">
                         <input type="hidden" id="timeline_hold" name="timeline" />
                         <input type="hidden" value="<?php echo $messageid; ?>" name="msg_id" />
                         <input type="hidden" name="ideaid" value ="<?php echo $ideaid ?>"/>
                         <input type="hidden" name="allowed[]" value="<?php echo $senderid; ?>"/>
                 <div id='timeline'></div>
                 </center>
                 </p>
                 <?php if(count($users) !=0): ?>
                 Following People have also requested to work with you on this project, if you do not select them now, these will be denied from working on this project. You can add them later once the project has been started but they can no longer see you in ideas section.

                 <center><ul id="list-user">
                   
                     <?php foreach($users as $user): ?>
                     <li><input name="allowed[]" type="checkbox" value="<?php echo $user['id']; ?>" /><?php echo $user['name'] ?></li>
                     <?php endforeach; ?>
                 </ul>
                 </center>
                 <?php endif; ?>
                <input type="Submit"  />
                </form>                 
                </div>
            <!-- END FEATURED -->
            
            

            <!-- A SEPARATOR -->
            <div class='bg-gap'>
            </div>
            <!-- END SEPARATOR -->
            <script>
                $('#timeline').DatePicker({
	flat: true,
	date: ['2014-06-03','2014-06-03'],
	current: '2014-06-03',
	calendars: 1,
	mode: 'range',
	starts: 1
});
$(document).on('click','#as',function(){
    //console.log($('#timeline').DatePickerGetDate(1));
});
$(document).on('submit','#ongoing-form',function(e){
    e.preventDefault();
    $('#timeline_hold').attr('value',$('#timeline').DatePickerGetDate(1));
    senddata = $('#ongoing-form').serialize();
    $.ajax({
        url : '<?php echo SITEURL; ?>user/toongoing',
        data : senddata
    }).done(function(data){
     window.location = "";
    });
});
            </script>