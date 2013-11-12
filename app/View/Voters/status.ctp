<div class="row">
    <div class="span12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')) ?>">Manajemen Pemilu</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'status', $election['Election']['id'])) ?>">Manajemen Status Pemilih</a></li>
            <li class="active">Index</li>
        </ol>

        <h1>Status Pemilih</h1>
        <p class="lead">Anda melakukan manajemen data untuk pemilih pada <strong><?php echo $election['Election']['name']; ?></strong>.</p>
        
        <table class="table">
            <tr>
                <td width="25%"><strong>Nama</strong></td>
                <td width="23%"><strong>E-mail</strong></td>
                <td width="12%"><strong>Status Voting-Key</strong></td>
                <td width="40%"><strong>Aksi</strong></td>
            </tr>
            <?php foreach ($voters as $voter) { ?>
            <tr>
                <td><em><?php echo $voter['Voter']['name']; ?></em></td>
                <td><code><?php echo $voter['Voter']['email']; ?></code></td>
                <td><?php echo $voter['VotingKey'][0]['activated'] ? "<span class='label label-success'>Sudah dipakai</span>" : "<span class='label label-warning'>Belum dipakai</span>"; ?></td>
                <td>
                    <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'resend_voting_key', $voter['Voter']['id'])) ?>" class="btn btn-warning"><span class="glyphicon glyphicon-send"></span> Kirim Ulang <em>Voting Key</em></a>
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

