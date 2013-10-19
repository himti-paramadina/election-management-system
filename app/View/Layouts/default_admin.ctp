<!DOCTYPE HTML>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> - Sistem Manajemen Pemilu
	</title>
	<?php
		echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('datepicker');
        echo $this->Html->css('election.style');
	?>
</head>
<body>
    <?php echo $this->Element('navigation'); ?>
	<div class="container">
        <?php if (AuthComponent::user()): ?>
        <div style="margin-top: 10px;">
            <p align="right">Halo <?php echo AuthComponent::user('name'); ?>! [<a href="<?php echo Router::url(array('controller' => 'administrators', 'action' => 'logout')) ?>">Logout</a>]</p>
        </div>
        <?php endif; ?>

        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->Element('footer'); ?>
	</div>
	
	<?php $this->element('sql_dump'); ?>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->Html->script('bootstrap-datepicker'); ?>
    <script type="text/javascript">
        $(function(){
            $('.datepicker').datepicker()
        });
        
        function toggleModal(action, url, id) {
           $('.confirm-' + action).attr('href', url + '/' + id);
           $("#" + action).modal('toggle');
        }
    </script>
</body>
</html>
