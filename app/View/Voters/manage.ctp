<div class="row">
    <div class="span12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')) ?>">Manajemen Pemilu</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'manage', $election['Election']['id'])) ?>">Manajemen Pemilih</a></li>
            <li class="active">Index</li>
        </ol>

        <div class="page-header">
            <h1>Manajemen Pemilih</h1>
        </div>
        <p class="lead">Anda melakukan manajemen data untuk pemilih pada <strong><?php echo $election['Election']['name']; ?></strong>.</p>
        <p>
            <?php if ($number_of_voting_keys == 0 && time() >= strtotime($election['Election']['start_time'])):?>
                <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'generate_keys', $election['Election']['id'])) ?>" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin akan meng-generate voting-keys untuk para pemilih ini? Aksi ini hanya bisa dilakukan 1 kali.')">Buat voting-keys untuk seluruh pemilih.</a>
            <?php elseif ($number_of_voting_keys > 0):?>
                <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'status', $election['Election']['id'])) ?>" class="btn btn-default"><span class="glyphicon glyphicon-stats"></span> Lihat Status Pemilih</a>
            <?php endif; ?>
        </p>
        <table class="table table-striped table-hover">
            <tr>
                <td width="25%" align="center"><strong>Nama</strong></td>
                <td width="23%" align="center"><strong>E-mail</strong></td>
                <td width="12%" align="center"><strong>Telepon</strong></td>
                <td width="13%" align="center"><strong>Terverifikasi?</strong></td>
                <td width="27%" align="center"><strong>Aksi</strong></td>
            </tr>
            <?php foreach ($voters as $voter) { ?>
            <tr>
                <td><em><?php echo $voter['Voter']['name']; ?></em></td>
                <td><code><?php echo $voter['Voter']['email']; ?></code></td>
                <td><?php echo $voter['Voter']['phone_number']; ?></td>
                <td align="center"><?php echo $voter['Voter']['verified'] ? "<span class='label label-success'>Ya</span>" : "<span class='label label-danger'>Tidak</span>"; ?></td>
                <td>
                    <?php if (!$voter['Voter']['verified'] && $number_of_voting_keys == 0): ?>
                    <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'verify', $voter['Voter']['id'])); ?>" class="btn btn-default" onclick="return confirm('Anda yakin akan memverifikasi pemilih dengan id <?php echo $voter['Voter']['id'];?> bernama <?php echo $voter['Voter']['name']; ?>?')"><span class='glyphicon glyphicon-ok'></span></a>
                    <?php elseif (!$voter['Voter']['verified'] && $number_of_voting_keys != 0): ?>
                    <a href="#" class="btn disabled"><span class='glyphicon glyphicon-ok'></span></a>
                    <?php else: ?>
                    <a href="#" class="btn btn-success disabled"><span class='glyphicon glyphicon-ok'></span></a>
                    <?php endif; ?>
                    <a href="" class="btn btn-info"><span class='glyphicon glyphicon-envelope'></span></a>
                    <a href="" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus pemilih dengan id <?php echo $voter['Voter']['id'];?> bernama <?php echo $voter['Voter']['name']; ?>?')"><span class='glyphicon glyphicon-trash'></span></a>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>

<!-- Pagination Container -->
<div class="row">
    <div class="span12">
        <p align="center">Halaman: <?php echo $this->Paginator->numbers(); ?></p>
    </div>
</div>

