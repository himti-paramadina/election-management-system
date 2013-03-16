<div class="navbar">
    <div class="navbar-inner">
        <a class="brand">Administrasi</a>
        <ul class="nav">
            <li>
                <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')); ?>"><i class="icon-home"></i> Atur Pemilu</a>
            </li>
            <li class="active"><a href="#"><i class="icon-user"></i> Kandidat</a></li>
            <li>
                <a href="<?php echo Router::url(array('controller' => 'candidates', 'action' => 'add', $election['Election']['id'])); ?>" target="_blank"><i class="icon-plus-sign"></i> Tambah Kandidat Baru</a>
            </li>
        </ul>
    </div>
</div>