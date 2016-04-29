<script type="text/javascript" language="javascript" src="<?php echo ASSETS; ?>slider/js/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo ASSETS; ?>slider/js/jquery.skitter.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo ASSETS; ?>slider/js/jquery.easing.1.3.js"></script>
        <link href="<?php echo ASSETS; ?>slider/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
        <style>
            .box_skitter{
                width:960px;
            }
            .image>a>img{
                display:none!important;
                
            }
        </style>
	<!-- Init Skitter -->
	<script type="text/javascript" language="javascript">
		$(document).ready(function() {
                    $('.container_skitter').find('img').css({'width' : '100px'});
                    
			$('.idea-slider').skitter({
				numbers_align: 'center',
				progressbar: true, 
				dots: true, 
				preview: true
			});
		});
	</script>
