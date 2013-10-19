<div class="row">
    <div class="col-md-12">
        <p align="center" style="padding: 0; margin: 0;"><a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'display', $election['Election']['identifier'])) ?>">
        <?php
            if ($election['Election']['banner_url']):
                echo $this->Html->image($election['Election']['banner_url'], array('class' => 'img-responsive'));
            endif;
        ?>
        </a></p>
    </div>
</div>