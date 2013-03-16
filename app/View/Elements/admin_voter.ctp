<div class="navbar">
    <div class="navbar-inner">
        <a class="brand">Administrasi</a>
        <ul class="nav">
            <li>
                <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')); ?>"><i class="icon-home"></i> Atur Pemilu</a>
            </li>
            <li class="active"><a href="#"><i class="icon-user"></i> Pemilih</a></li>
            <li>
                <a href="<?php echo Router::url(array('controller' => 'voters', 'action' => 'status', $election['Election']['id'])); ?>" target="_blank"><i class="icon-list"></i> Status</a>
            </li>
        </ul>
    </div>
</div>