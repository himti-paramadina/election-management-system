<!DOCTYPE HTML>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('election.style');
    ?>
    
    <?php
        echo $this->Html->script('http://code.jquery.com/jquery-latest.js');
        echo $this->Html->script('jquery.countdown.min.js');
        echo $this->Html->script('jquery.countdown-id.js');
    ?>

    <script>
        var currenttime = '<?php echo date("F d, Y H:i:s", time())?>' // PHP method of getting server date
    </script>
</head>
<body>
    <?php echo $this->Element('navigation'); ?>
	<div class="container">
        <?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
        <?php echo $this->Element('footer'); ?>
	</div>
	
	<?php // echo $this->element('sql_dump'); ?>
    
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->Html->script('servertime'); ?>

</body>
</html>

