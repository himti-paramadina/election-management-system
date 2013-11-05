<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')) ?>">Manajemen Pemilu</a></li>
            <li class="active">Index</li>
        </ol>

        <div class="page-header">
            <h1>Manajemen Pemilu</h1>
        </div>
        <p class="lead">Halaman ini adalah halaman indeks pemilu. Untuk membuat pemilu baru: <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'create')) ?>" class="btn btn-default"><span class="glyphicon glyphicon-check"></span> Buat Pemilu</a></p>
        <table class="table table-striped">
            <?php foreach ($elections as $election) { ?>
            <tr>
                <td width="50%">
                    <a class="btn btn-default btn-block"><strong><?php echo $election['Election']['name']; ?></strong></a>
                    <p align="center">Pelaksanaan: <span class="label label-default"><?php echo $election['Election']['start_time'] ?></span> s.d. <span class="label label-default"><?php echo $election['Election']['end_time'] ?></span></p>
                </td>
                <td width="50%">
                    <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'manage', $election['Election']['id'])); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-bullhorn"></span> Atur Pemilih</a>
                    <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'manage', $election['Election']['id'])); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-user"></span> Atur Kandidat</a>
                    <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'edit', $election['Election']['id'])); ?>" class="btn btn-info"><span class="glyphicon glyphicon-saved"></span> Ubah Data Pemilu</a>
                    <a href="#" class="btn btn-danger" onclick="toggleModal('delete', '<?php echo Router::url(array('controller' => 'elections', 'action' => 'delete')); ?>', '<?php echo $election['Election']['id']; ?>');"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<!-- Modal Forms -->
<div id="generate" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Buat Voting-Keys</h3>
    </div>
    <div class="modal-body">
        <p>Dengan mengklik ini, berarti Anda akan membuat voting-key untuk seluruh pemilih yang telah mendaftar
        atau didaftarkan oleh Anda. Proses ini hanya bisa dilakukan 1 kali, dan sekali diaktifkan, maka seluruh
        data akan dikunci oleh sistem sampai pemilihan selesai.</p>
        <p>Jika Anda merasa telah yakin untuk melakukan apa yang mestinya Anda lakukan, silakan lanjutkan
        langkah ini sesuai dengan kesadaran Anda.</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
        <a href="#" class="btn btn-danger confirm-generate">Buat sekarang!</a>
    </div>
</div>

<div id="delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Hapus Pemilu</h3>
    </div>
    <div class="modal-body">
        <p>Dengan mengklik ini, berarti Anda akan menghapus data pemilu seluruhnya, tentunya beserta data
            pemilih, kandidat, serta voting-key yang ada. Data yang telah dihapus tidak dapat dipulihkan
        kembali.</p>
        <p>Jika Anda merasa telah yakin untuk melakukan apa yang mestinya Anda lakukan, silakan lanjutkan
        langkah ini sesuai dengan kesadaran Anda.</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
        <a href="#" class="btn btn-danger confirm-delete">Hapus!</a>
    </div>
</div>

