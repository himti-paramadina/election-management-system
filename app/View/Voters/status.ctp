<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')) ?>">Manajemen Pemilu</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'status', $election['Election']['id'])) ?>">Manajemen Status Pemilih</a></li>
            <li class="active">Index</li>
        </ol>

        <div class="page-header">
            <h1>Status Pemilih</h1>
        </div>

        <p class="lead">Anda melakukan manajemen data untuk pemilih pada <strong><?php echo $election['Election']['name']; ?></strong>.</p>
        
        <table class="table table-hover">
            <tr>
                <td width="25%"><strong>Nama</strong></td>
                <td width="23%"><strong>E-mail</strong></td>
                <td width="20%"><strong>Status Voting Key</strong></td>
                <td width="32%"><strong>Aksi</strong></td>
            </tr>
            <?php foreach ($voters as $voter) { ?>
            <tr>
                <td><em><?php echo $voter['Voter']['name']; ?></em></td>
                <td><code><?php echo $voter['Voter']['email']; ?></code></td>
                <td><?php echo $voter['VotingKey'][0]['activated'] ? "<span class='label label-success'>Sudah dipakai</span>" : "<span class='label label-warning'>Belum dipakai</span>"; ?></td>
                <td>
                    <p align="center" style="margin: 0; padding: 0;"></p>
                    <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'resend_voting_key', $voter['Voter']['id'])) ?>" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-send"></span></a>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>

<!-- Pagination Container -->
<div class="row">
    <div class="col-md-12">
        <p align="center">Halaman: <?php echo $this->Paginator->numbers(); ?></p>
    </div>
</div>

