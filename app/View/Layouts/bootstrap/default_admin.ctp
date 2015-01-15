<!DOCTYPE HTML>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> - Sistem Manajemen Pemilu
	</title>
	<?php
		echo $this->Html->css('../components/bootstrap/dist/css/bootstrap.min.css');
        echo $this->Html->css('datepicker');
        echo $this->Html->css('election.style');
	?>
    <script>
        var currenttime = '<?php echo date("F d, Y H:i:s", time())?>' // PHP method of getting server date
    </script>
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
	
	<?php echo $this->Html->script('../components/jquery/dist/jquery.min.js'); ?>
    <?php echo $this->Html->script('../components/bootstrap/dist/js/bootstrap.min.js'); ?>
    <?php echo $this->Html->script('servertime.js'); ?>
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
    <?php echo $this->fetch('script_blocks') ?>
</body>
</html>
