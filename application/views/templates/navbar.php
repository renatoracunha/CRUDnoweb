<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="#"><img src="<?= base_url('assets/images/teste.jpg') ?>" alt="icon" width="30" height="30"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only"></span></a>
            </li>
            <?php if (!empty($_SESSION)) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/index.php/main/view/client') ?>">Gerenciar <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/index.php/main/view/registerevent') ?>">Cadastrar<span class="sr-only"></span></a>
                </li>
            <?php endif; ?>
            <?php if (empty($_SESSION)) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/index.php/main/view/login') ?>">Login <span class="sr-only"></span></a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/index.php/main/logout') ?>">Logout <span class="sr-only"></span></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>