<div class="row">
    <div class="span12">
        <h1>Vote! <small><?php echo $election['Election']['name']; ?></small></h1>
        
        <p>
            Kamu akan memilih kandidat <?php echo $candidate['Candidate']['name']; ?>. Untuk melanjutkan,
            kamu harus memiliki voting-key untuk memilih. Voting-key adalah 32 karakter pengenal yang
            diberikan kepada kamu via e-mail atau langsung dari KPU saat melakukan pemilihan di tempat.
            Ketikkan sesuai dengan format yang telah kamu dapatkan dari KPU.
        </p>
        <p>
            <span class="label label-warning">Peringatan!</span> Voting-key yang kamu miliki hanya bisa dipakai
            <span style="color: red;"><strong>1 kali</strong></span> dalam pemilihan. Pastikan kamu menggunakannya dengan
            bijaksana. :)
        </p>
        
        <p align="center">
            <?php echo $candidate['Candidate']['img_url'] == NULL ? $this->Html->image('http://placehold.it/400x200', array('class' => 'thumbnail')):$this->Html->image($candidate['Candidate']['img_url'], array('class' => 'thumbnail')); ?>
        </p>
        
        <?php echo $this->Form->create(null, array(
            'url' => array('controller' => 'candidates', 'action' => 'vote', $candidate['Candidate']['id']),
            'class' => 'form-inline'
        )); ?>
        
        <p align="center">
            <label>Masukkan Voting-Key kamu: </label>
            <input type="text" style="width: 400px;" name="data[VotingKey][voting_key]" placeholder="Voting-Key (XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX)" id="VotingKeyVotingKey"/>
            <input type="submit" class="btn btn-warning" value="Vote!"/>
        </p>
        
        <?php echo $this->Form->end(); ?>
        
    </div>
</div>