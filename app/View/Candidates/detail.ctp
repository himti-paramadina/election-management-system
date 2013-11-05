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
            <h1>Kandidat <small><?php echo $election['Election']['name'] ?></small></h1>
        </div>

        <h2 align="center">
            <?php echo $candidate['Candidate']['name']; ?>
            <?php if ($candidate['Candidate']['name2'] != NULL): ?>
                <?php echo '&amp; ' . $candidate['Candidate']['name2']; ?>
            <?php endif; ?>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <?php echo $candidate['Candidate']['img_url'] == NULL ? $this->Html->image('http://placehold.it/400x200', array('class' => 'thumbnail')):$this->Html->image($candidate['Candidate']['img_url'], array('class' => 'thumbnail')); ?>

        <?php if (time() > strtotime($election['Election']['start_time']) && time() <= strtotime($election['Election']['end_time'])): ?>
        <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'vote', $candidate['Candidate']['id'])) ?>" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-heart"></span> <em>Vote</em> <?php echo $candidate['Candidate']['name']; ?><?php if ($candidate['Candidate']['name2'] != NULL): ?><?php echo '&amp; ' . $candidate['Candidate']['name2']; ?><?php endif; ?>!
        </a>
        <?php endif; ?>
    </div>
    <div class="col-md-7">
        <?php echo $candidate['Candidate']['description']; ?>
    </div>
</div>