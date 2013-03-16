<div class="row">
    <div class="span12">
        <h1>Kandidat</h1>
        <h1><?php echo $election['Election']['name']; ?></h1>
        <?php if (time() <= strtotime($election['Election']['start_time'])): ?>
        <p class="lead">Siapakah pemimpin Himpunan Mahasiswa Teknik Informatika Universitas Paramadina
        selanjutnya? Sebelum memilih, kenali pilihan kamu lebih dekat. :)</p> 
        <?php elseif (time() > strtotime($election['Election']['start_time']) && time() <= strtotime($election['Election']['end_time'])): ?>
        <p class="lead">Waktu pemilihan telah tiba! Ayo pilih kandidatmu, pilihanmu menentukan
        masa depan HIMTI. :)</p>
        <?php else: ?>
        <p class="lead">Pemimpin Himpunan Mahasiswa Teknik Informatika Universitas Paramadina
        telah terpilih. Inilah kandidat yang bertarung di dalamnya. :)</p> 
        <?php endif; ?>
    </div>
</div>
<?php foreach ($candidates as $candidate) { ?>
<div class="row">
    <div class="span5" style="text-align: center;">
        <?php echo $candidate['Candidate']['img_url'] == NULL ? $this->Html->image('http://placehold.it/400x200', array('class' => 'thumbnail')):$this->Html->image($candidate['Candidate']['img_url'], array('class' => 'thumbnail')); ?>
    </div>
    <div class="span7">
        <h2><?php echo $candidate['Candidate']['name']; ?></h2>
        <?php if ($candidate['Candidate']['name2'] != NULL) {?>
        <h2><?php echo $candidate['Candidate']['name2']; ?></h2>
        <?php } ?>
        <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'detail', $candidate['Candidate']['id'])); ?>" class="btn">Lihat lebih detail <i class="icon-chevron-right"></i></a>
        
        <?php        
        if (time() > strtotime($election['Election']['start_time']) && time() <= strtotime($election['Election']['end_time'])): ?>
        <a href="#" class="btn btn-warning" onclick="toggleModal('vote-candidate-<?php echo $candidate['Candidate']['id'] ?>', '<?php echo Router::url(array('controller' => 'candidates', 'action' => 'vote')); ?>', '<?php echo $candidate['Candidate']['id']; ?>');"><i class="icon-heart"></i> Vote</a>
        <?php endif; ?>
    </div>
    <div style="height: 20px; display: block; clear: both;"></div>
</div>

<?php if (time() > strtotime($election['Election']['start_time']) && time() <= strtotime($election['Election']['end_time'])): ?>
<!-- Modal Forms -->
<div id="vote-candidate-<?php echo $candidate['Candidate']['id'] ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Vote!</h3>
    </div>
    <div class="modal-body">
        <?php 
            $this->Form->create(null, array(
                'url' => array('controller' => 'candidates', 'action' => 'vote', )
            ));
        ?>
        
        <?php $this->Form->end(); ?>
        <p>Dengan mengklik ini, berarti Anda akan melakukan vote untuk kandidat</p>
        <p style="text-align: center;">
            <?php echo $candidate['Candidate']['img_url'] == NULL ? $this->Html->image('http://placehold.it/400x200', array('class' => 'img-polaroid')):$this->Html->image($candidate['Candidate']['img_url'], array('class' => 'img-polaroid')); ?>
        </p>
        <p>Jika Anda merasa telah yakin untuk melakukan apa yang mestinya Anda lakukan, silakan lanjutkan
        langkah ini sesuai dengan kesadaran Anda.</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
        <a href="#" class="btn btn-warning confirm-vote-candidate-<?php echo $candidate['Candidate']['id'] ?>"><i class="icon-heart"></i> Vote!</a>
    </div>
</div>
<?php endif; ?>
<?php } ?>

<script>
    function toggleModal(action, url, id) {
        $('.confirm-' + action).attr('href', url + '/' + id);
        $("#" + action).modal('toggle');
    }
</script>