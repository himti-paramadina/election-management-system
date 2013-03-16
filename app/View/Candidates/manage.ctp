<div class="row">
    <div class="span12">
        <?php echo $this->Element('admin_candidate'); ?>
        <h1>Data Kandidat</h1>
        <p class="lead">Anda melakukan manajemen data untuk kandidat pada <strong><?php echo $election['Election']['name']; ?></strong>.</p>
        <table class="table">
            <tr>
                <td width="25%"><strong>Nama Ketua</strong></td>
                <td width="25%"><strong>Nama Wakil</strong></td>
                <td width="25%"><strong>E-mail</strong></td>
                <td width="25%"><strong>Aksi</strong></td>
            </tr>
            <?php foreach ($candidates as $candidate) { ?>
            <tr>
                <td><?php echo $candidate['Candidate']['name']; ?></td>
                <td><?php echo $candidate['Candidate']['name2'] == NULL ? '<em>Tidak Ada</em>':$candidate['Candidate']['name2']; ?></td>
                <td><?php echo $candidate['Candidate']['email']; ?></td>
                <td>
                    <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'edit', $candidate['Candidate']['id'])); ?>" class="btn"><i class="icon-pencil"></i></a>
                    <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'delete', $candidate['Candidate']['id'])); ?>" class="btn btn-danger"><i class="icon-trash"></i></a>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
