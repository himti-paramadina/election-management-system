<div class="row">
    <div class="span12">
        <?php echo $this->Element('admin_election'); ?>
        <h1>Manajemen Pemilu</h1>
        <table class="table">
            <?php foreach ($elections as $election) { ?>
            <tr>
                <td width="100%">
                    <h3><?php echo $election['Election']['name']; ?></h3>
                    <p>Pelaksanaan: <?php echo $election['Election']['start_time'] ?> s.d. <?php echo $election['Election']['end_time'] ?></p>
                    <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'manage', $election['Election']['id'])); ?>" class="btn">Atur Pemilih</a>
                    <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'manage', $election['Election']['id'])); ?>" class="btn">Atur Kandidat</a>
                    <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'edit', $election['Election']['id'])); ?>" class="btn">Ubah Data Pemilu</a>
                    <a href="#" class="btn btn-danger" onclick="toggleModal('delete', '<?php echo Router::url(array('controller' => 'elections', 'action' => 'delete')); ?>', '<?php echo $election['Election']['id']; ?>');">Hapus</a>
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

