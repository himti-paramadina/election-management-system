<div class="row">
    <div class="col-md-12">
        <p align="center" style="padding: 0; margin: 0;"><a href="<?php echo Router::url('/info/' . $election['Election']['identifier']) ?>">
        <?php
            if ($election['Election']['banner_url']):
                echo $this->Html->image($election['Election']['banner_url'], array('class' => 'img-responsive'));
            endif;
        ?>
        </a></p>
    </div>
</div>
<?php if (time() > strtotime($election['Election']['start_time']) && time() < strtotime($election['Election']['end_time'])): ?>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <strong>Pengambilan Suara Sedang Berlangsung</strong>
            </div>
            <div class="panel-body">
                <p>Pilih kandidatmu dengan mengklik tombol <em>Vote</em> yang ada di halaman visi dan misi mereka! <span id="defaultCountdown2"></span></p>
            </div>
        </div>
    </div>
</div>
<?php elseif (time() > strtotime($election['Election']['announcement_time'])): ?>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1 style="font-weight: bold;">Kandidat <small><?php echo $election['Election']['name'] ?></small></h1>
        </div>

        <div class="row">
        <?php $mod = 0; ?>
        <?php foreach ($election['Candidate'] as $candidate): $mod++;?>
            
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p align="center"><?php echo $this->Html->image($candidate['img_url'], array('class' => 'img-responsive thumbnail')) ?></p>
                        <h2 align="center" style="margin: 0; padding: 0; font-weight: bold;"><?php echo $candidate['name'] ?></h3>
                        <h2 align="center" style="margin: 0 0 20px 0; padding: 0; font-weight: bold;"><?php echo $candidate['name2'] ?></h3>
                        <a class="btn btn-lg btn-success btn-block" href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'detail', $election['Election']['identifier'], $candidate['candidate_unique_identifier'])) ?>"><span class="glyphicon glyphicon-check"></span> Kenali Lebih Dekat</a>
                    </div>
                </div>
            </div>
            <?php if ($mod % 2 == 0): ?>
            <p class="separator" style="width: 100%; display: block; clear: both; margin: 0; padding: 0; height: 10px;">&nbsp;</p>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="page-header">
            <h1 style="font-weight: bold;">Informasi Terbaru <small><?php echo $election['Election']['name'] ?></small></h1>
        </div>

        <h1><a href="<?php echo Router::url(array('controller' => 'posts', 'action' => 'view', $election['Election']['identifier'], $election['Post'][0]['post_unique_identifier'])) ?>"><?php echo $election['Post'][0]['title'] ?></a></h1>
        <p><em><?php echo $election['Post'][0]['created'] ?></em></p>
        <?php echo $election['Post'][0]['excerpt'] ?>


    </div>
    <div class="col-md-3">

        <h2>Bersiaplah Untuk Memilih!</h2>

        <div class="panel panel-default">
            <div class="panel-body">
                <h1 align="center"><span class="label label-info"><?php echo count($voters) ?></span></h1>
                <h3 align="center">Pemilih Terdaftar</h3>
            </div>
        </div>

        <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'register', $election['Election']['identifier'])) ?>" class="btn btn-danger btn-lg btn-block">Daftar Sebagai Pemilih</a>

        <div style="margin-top: 10px;" id="defaultCountdown"></div>
    </div>
</div>

<script type="text/javascript">
    var electionStartDate = '<?php echo $election['Election']['start_time']; ?>';
    var electionEndDate = '<?php echo $election['Election']['end_time']; ?>';

    $(function () {
        var registrationExpirationDay = new Date(electionStartDate);
        $('#defaultCountdown').countdown({until: registrationExpirationDay,
            layout: 'Pendaftaran pemilih masih dibuka selama <strong>{dn} {dl}, {hn} {hl}, {mn} {ml}, dan {sn} {sl}</strong>.'});

        var electionEndTime = new Date(electionEndDate);
        $('#defaultCountdown2').countdown({until: electionEndTime,
            layout: 'Pemilu masih berlangsung selama <strong>{dn} {dl}, {hn} {hl}, {mn} {ml}, dan {sn} {sl}</strong> lagi.'});
    });

</script>