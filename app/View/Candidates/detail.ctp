<div class="row">
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'display', $election['Election']['identifier'])); ?>">
                Kandidat <?php echo $election['Election']['name'] ?>
            </a> <span class="divider">/</span></li>
        <li>
            <?php echo $candidate['Candidate']['name']; echo $candidate['Candidate']['name2'] == NULL ? '': ' & ' . $candidate['Candidate']['name2'];?>
        </li>
    </ul>
    <div class="span5">
        <?php echo $candidate['Candidate']['img_url'] == NULL ? $this->Html->image('http://placehold.it/400x200', array('class' => 'thumbnail')):$this->Html->image($candidate['Candidate']['img_url'], array('class' => 'thumbnail')); ?>
        <h2><?php echo $candidate['Candidate']['name']; ?></h2>
        <?php if ($candidate['Candidate']['name2'] != NULL) {?>
        <h2><?php echo $candidate['Candidate']['name2']; ?></h2>
        <?php } ?>
        
        <?php if (time() > strtotime($election['Election']['start_time']) && time() <= strtotime($election['Election']['end_time'])): ?>
        <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'vote', $candidate['Candidate']['id'])) ?>" class="btn btn-warning"><i class="icon-heart"></i> Vote!</a>
        <?php endif; ?>
    </div>
    <div class="span7">
        <?php echo $candidate['Candidate']['description']; ?>
    </div>
</div>