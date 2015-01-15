<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>Portal Pemilihan Umum</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?php foreach ($elections as $election): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?php echo $election['Election']['name']; ?></strong>
                </div>
                <div class="panel-body">
                    <?php
                        if ($election['Election']['banner_url']):
                            echo $this->Html->image($election['Election']['banner_url'], array('class' => 'img-responsive img-thumbnail'));
                        endif;
                    ?>
                    <p align="center" style="margin-top: 10px;">Pelaksanaan: <span class="label label-warning"><?php echo $election['Election']['start_time'] ?></span></p>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="<?php echo Router::url('/info/' . $election['Election']['identifier']) ?>" class="btn btn-info btn-block"><span class="glyphicon glyphicon-search"></span> Informasi Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p><strong>Anda ingin melaksanakan kegiatan pemilihan umum secara <em>online</em>?</strong></p>
        <p>Sistem Manajemen Pemilu yang dikembangkan oleh HIMTI Paramadina merupakan sistem terintegrasi yang dapat Anda gunakan
        untuk melakukan pemilihan umum. Untuk informasi selengkapnya, hubungi
        humas HIMTI Paramadina, atau kirimkan email ke <code>litbang[at]himti.paramadina.ac.id</code>.</p>
    </div>
</div>
