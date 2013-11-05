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
<div class="row">
    <div class="col-md-9">
        <div class="page-header">
            <h1>Informasi Terbaru <small><?php echo $election['Election']['name'] ?></small></h1>
        </div>

        <h1><a href="#"><?php echo $election['Post'][0]['title'] ?></a></h1>
        <p><em><?php echo $election['Post'][0]['created'] ?></em></p>
        <?php echo $election['Post'][0]['excerpt'] ?>

        <div class="page-header">
            <h1>Kandidat <small><?php echo $election['Election']['name'] ?></small></h1>
        </div>

        <?php foreach ($election['Candidate'] as $candidate): ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p align="center"><?php echo $this->Html->image($candidate['img_url'], array('class' => 'img-responsive thumbnail')) ?></p>
                            <h3 align="center" style="margin: 0; padding: 0;"><?php echo $candidate['name'] ?></h3>
                            <h3 align="center" style="margin: 0 0 10px 0; padding: 0;"><?php echo $candidate['name2'] ?></h3>
                            <a class="btn btn-warning btn-block" href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'detail', $election['Election']['identifier'], $candidate['candidate_unique_identifier'])) ?>"><span class="glyphicon glyphicon-check"></span> Kenali Lebih Dekat</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="col-md-3">
        <h2>Informasi</h2>

        <?php foreach ($election['Post'] as $post): ?>
            <h4><a href="#"><?php echo $post['title'] ?></a></h4>
        <?php endforeach; ?>

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

    $(function () {
        var registrationExpirationDay = new Date(electionStartDate);
        $('#defaultCountdown').countdown({until: registrationExpirationDay,
            layout: 'Pendaftaran pemilih masih dibuka selama <strong>{dn} {dl}, {hn} {hl}, {mn} {ml}, dan {sn} {sl}</strong>.'});
        $('#year').text(registrationExpirationDay.getFullYear());
    });
</script>