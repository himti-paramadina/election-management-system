<!DOCTYPE HTML>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
            <?php echo $title_for_layout; ?> - Menuju HIMTI-1
    </title>
    <?php
    
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('election.style');
    ?>
    
    <?php echo $this->Html->script('http://code.jquery.com/jquery-latest.js'); ?>
        
</head>
<body>
	<div class="container">
        <p align="center">
            <a href="<?php echo Router::url('/') ?>">
                <?php echo $this->Html->image('kpu.png'); ?>
            </a>
        </p>
        <?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
        <?php echo $this->Element('footer'); ?>
	</div>
	
	<?php // echo $this->element('sql_dump'); ?>
    
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->Html->script('jquery.countdown') ?>
</body>
</html>

