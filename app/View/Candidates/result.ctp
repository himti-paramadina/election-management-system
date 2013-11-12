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
<div class="row" style="padding-top: 20px;">
    <div class="col-md-9">
        <h1>Hasil Pemungutan Suara <small><?php echo $election['Election']['name'];?></small></h1>
    </div>
    <div class="col-md-3">
        <p>Klik tombol berikut untuk melihat hasil pemungutan suara.</p>
        <a href="#" id="show" class="btn btn-warning">Lihat Hasil Pemungutan Suara</a>
    </div>
    <p class="clearfix"></p>
</div>

<div id="candidates" style="display: none">
<?php
    $i = 0;
    foreach ($results as $result) {
?>

<div class="row" id="candidate<?php echo $i ?>" style="margin-bottom: 10px;">
    <div class="col-md-4">
        <?php echo $result['candidates']['img_url'] == NULL ? $this->Html->image('http://placehold.it/400x200', array('class' => 'thumbnail')):$this->Html->image($result['candidates']['img_url'], array('class' => 'img-responsive thumbnail')); ?>
    </div>
    <div class="col-md-8">
        <h3 style="margin-top:0;"><?php echo $result['candidates']['name'];?> <?php if ($result['candidates']['name2'] != null) echo ' & ' . $result['candidates']['name2']; ?></h3>
        <div id="bar<?php echo $i ?>" style="width: 0; height: 70px; background-color: <?php printf( "#%06X\n", mt_rand( 0, 0xFFFFFF )); ?>; opacity: 0.2;">
            <h3 class="percent<?php echo $i ?>" style="color: #ffffff; display: none; float: right; margin-right: 10px;"><?php echo floor($result[0]['num'] * 100 / $total); ?>%</h3>
        </div>
        <h4 class="percent<?php echo $i ?>" style="display: none;">Total Pemilih: <?php echo $result[0]['num']; ?> Suara</h4>
    </div>
</div>

<?php
        $i++;
    }
?>
    <div class="row">
        <p align="center" style="margin: 10px 0px;">Selamat kepada kandidat terpilih. - Komisi Pemilihan Umum, HIMTI Paramadina</p>
    </div>
</div>
    
<script>
    $("#show").click(function(){
        $("#candidates").toggle('fast');
        
        <?php 
        $i = 0;
        foreach ($results as $result):
        ?>
        $("#bar<?php echo $i ?>").animate({
            opacity: 1,
            width: '<?php echo floor($result[0]['num'] * 100 / $total); ?>%'
        },
        4000,
        function() {
            $(".percent<?php echo $i ?>").fadeIn('slow');
        });
        <?php
            $i++;
        endforeach;
        ?>
    });
</script>