<div class="row">
    <div class="span12">
        <?php echo $this->Element('admin_voter');?>
        <h1>Data Pemilih</h1>
        <p class="lead">Anda melakukan manajemen data untuk pemilih pada <strong><?php echo $election['Election']['name']; ?></strong>.</p>
        <p>
            <?php if ($number_of_voting_keys == 0):?>
                <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'generate_keys', $election['Election']['id'])) ?>" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin akan meng-generate voting-keys untuk para pemilih ini? Aksi ini hanya bisa dilakukan 1 kali.')">Buat voting-keys untuk seluruh pemilih.</a>
            <?php endif; ?>
        </p>
        <table class="table">
            <tr>
                <td width="25%"><strong>Nama</strong></td>
                <td width="23%"><strong>E-mail</strong></td>
                <td width="12%"><strong>Terverifikasi?</strong></td>
                <td width="13%"><strong>Telepon</strong></td>
                <td width="27%"><strong>Aksi</strong></td>
            </tr>
            <?php foreach ($voters as $voter) { ?>
            <tr>
                <td><?php echo $voter['Voter']['name']; ?></td>
                <td><?php echo $voter['Voter']['email']; ?></td>
                <td><?php echo $voter['Voter']['verified'] ? "Ya" : "Tidak"; ?></td>
                <td><?php echo $voter['Voter']['phone_number']; ?></td>
                <td>
                    <?php if (!$voter['Voter']['verified'] && $number_of_voting_keys == 0): ?>
                    <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'verify', $voter['Voter']['id'])); ?>" class="btn" onclick="return confirm('Anda yakin akan memverifikasi pemilih dengan id <?php echo $voter['Voter']['id'];?> bernama <?php echo $voter['Voter']['name']; ?>?')"><i class="icon-ok"></i></a>
                    <?php elseif (!$voter['Voter']['verified'] && $number_of_voting_keys != 0): ?>
                    <a href="#" class="btn disabled"><i class="icon-ok"></i></a>
                    <?php else: ?>
                    <a href="#" class="btn btn-warning disabled"><i class="icon-ok"></i></a>
                    <?php endif; ?>
                    <a href="" class="btn"><i class="icon-envelope"></i></a>
                    <a href="" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus pemilih dengan id <?php echo $voter['Voter']['id'];?> bernama <?php echo $voter['Voter']['name']; ?>?')"><i class="icon-trash"></i></a>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>

<!-- Pagination Container -->
<div class="row">
    <div class="span12">
        <p>Halaman: <?php echo $this->Paginator->numbers(); ?></p>
    </div>
</div>

