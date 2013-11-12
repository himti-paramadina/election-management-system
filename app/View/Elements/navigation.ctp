<nav class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo Router::url('/') ?>">Sistem Manajemen Pemilu</a>
    </div>

    <?php if (AuthComponent::user()): ?>
    <div>
        <ul class="nav navbar-nav">
            <li><a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')) ?>"><span class="glyphicon glyphicon-wrench"></span> <em>Dashboard</em></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-book"></span> <em>E-mail Templates</em></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> <em>Users</em></a></li>
        </ul>
    </div>
    <?php endif; ?>

    <div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#" style="color: white;"><span class="glyphicon glyphicon-time"></span> <span id="servertime"></span></a></li>
        </ul>
    </div>
</nav>