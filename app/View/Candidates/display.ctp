<div class="row">
    <div class="col-md-12">
        <p align="center" style="padding: 0; margin: 0;"><a href="<?php echo Router::url('/info/' . $election['Election']['identifier']) ?>">
        <?php
            if ($election['Election']['banner_url']):
                echo $this->Html->image($election['Election']['banner_url'], array('class' => 'img-responsive'));
            endif;
        ?>
        </a></p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>Kandidat <small><?php echo $election['Election']['name']; ?></small></h1>
        </div>
    </div>
</div>
<?php foreach ($candidates as $candidate): ?>
<div class="row">
    <div class="col-md-5 col-md-offset-1" style="text-align: center;">
        <?php echo $candidate['Candidate']['img_url'] == NULL ? $this->Html->image('http://placehold.it/400x200', array('class' => 'thumbnail')):$this->Html->image($candidate['Candidate']['img_url'], array('class' => 'thumbnail')); ?>
    </div>
    <div class="col-md-5">
        <h2 style="margin: 0;"><?php echo $candidate['Candidate']['name']; ?></h2>
        <?php if ($candidate['Candidate']['name2'] != NULL) {?>
        <h2 style="margin: 0 0 10px 0;"><?php echo $candidate['Candidate']['name2']; ?></h2>
        <?php } ?>
        <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'detail', $election['Election']['identifier'], $candidate['Candidate']['candidate_unique_identifier'])); ?>" class="btn btn-default"><span class="glyphicon glyphicon-check"></span> Kenali Lebih Dekat</a>
        
        <?php        
        if (time() > strtotime($election['Election']['start_time']) && time() <= strtotime($election['Election']['end_time'])): ?>
        <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'vote', $candidate['Candidate']['id'])) ?>" class="btn btn-warning"><span class="glyphicon glyphicon-heart"></span> Vote</a>
        <?php endif; ?>
    </div>
    <div style="height: 20px; display: block; clear: both;"></div>
</div>
<?php endforeach; ?>