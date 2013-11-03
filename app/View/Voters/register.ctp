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
    <div class="col-md-4">
        <h1>Registrasi Pemilih</h1>
        <p>Kamu akan mendaftar sebagai pemilih pada <strong><?php echo $election['Election']['name']; ?></strong></p>
        <?php echo $this->Form->create(null, array(
                    'url' => array('controller' => 'voters', 'action' => 'register', $election_identifier)
                )); 
        ?>

            <legend>Form Registrasi</legend>
            <div class="form-group">
            <?php echo $this->Form->input('name', array(
                'label' => 'Nama Lengkap',
                'placeholder' => 'Nama Lengkap',
                'class' => 'form-control'
            )); ?>
            </div>

            <div class="form-group">
            <?php echo $this->Form->input('email', array(
                'label' => 'E-mail',
                'placeholder' => 'E-mail',
                'class' => 'form-control'
            )); ?>
            </div>

            <div class="form-group">
            <?php echo $this->Form->input('phone_number', array(
                'label' => 'No. Telp.',
                'placeholder' => 'No. Telp',
                'class' => 'form-control'
            )); ?>
            </div>

            <button type="submit" class="btn btn-block btn-primary">Daftar</button>

        <?php $this->Form->end(); ?>
    </div>
    <div class="col-md-8">
        <!-- Registration Info -->

        <h2 id="defaultCountdown"></h2>

        <?php echo $election['Election']['registration_info']; ?>
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