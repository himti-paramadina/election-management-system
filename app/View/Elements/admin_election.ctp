<div class="navbar">
    <div class="navbar-inner">
        <a class="brand">Administrasi</a>
        <ul class="nav">
            <li class="active"><a href="#"><i class="icon-home"></i> Atur Pemilu</a></li>
            <li>
                <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'create')) ?>" target="_blank"><i class="icon-plus-sign"></i> Buat Pemilu Baru</a>
            </li>
        </ul>
        
        <ul class="nav pull-right">
            <li>
                <a href="<?php echo Router::url(array('controller' => 'administrators', 'action' => 'manage')) ?>"><i class="icon-user"></i> Administrator</a>
            </li>
        </ul>
    </div>
</div>