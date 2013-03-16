<div class="row">
    <div class="span12">
        <?php echo $this->Element('admin_voter');?>
        <h1>Status Pemilih</h1>
        <p class="lead">Anda melakukan manajemen data untuk pemilih pada <strong><?php echo $election['Election']['name']; ?></strong>.</p>
        
        <table class="table">
            <tr>
                <td width="25%"><strong>Nama</strong></td>
                <td width="23%"><strong>E-mail</strong></td>
                <td width="12%"><strong>Status Voting-Key</strong></td>
                <td width="40%"><strong>Informasi</strong></td>
            </tr>
            <?php foreach ($voters as $voter) { ?>
            <tr>
                <td><?php echo $voter['Voter']['name']; ?></td>
                <td><?php echo $voter['Voter']['email']; ?></td>
                <td><?php echo $voter['VotingKey'][0]['activated'] ? "<span class='label label-success'>Sudah dipakai</span>" : "<span class='label label-warning'>Belum dipakai</span>"; ?></td>
                <td>
                    
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

