<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')) ?>">Manajemen Pemilu</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'manage', $election['Election']['id'])) ?>">Manajemen Kandidat</a></li>
            <li class="active">Index</li>
        </ol>

        <div class="page-header">
            <h1>Data Kandidat</h1>
        </div>
        <p class="lead">Anda melakukan manajemen data untuk kandidat pada <strong><?php echo $election['Election']['name']; ?></strong>.</p>
        <table class="table table-hover">
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
                <td><code><?php echo $candidate['Candidate']['email']; ?></code></td>
                <td>
                    <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'edit', $candidate['Candidate']['id'])); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'delete', $candidate['Candidate']['id'])); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
