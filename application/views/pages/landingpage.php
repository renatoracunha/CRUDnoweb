<div class="main">
    <div class="container">
        <center>
            <h1>Nossos Eventos</h1>
        </center>
        <div class="main-card w-100">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    foreach ($events as $key => $value) {
                        $active = '';
                        if (empty($key + 1))
                            $next_slide = $key + 1;
                        else
                            $next_slide = 0;
                        if ($key == 0)
                            $active = 'class="active"';
                        echo ' <li data-target="#carouselExampleCaptions" data-slide-to="' . $next_slide . '" ' . $active . '></li>';
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    foreach ($events as $key => $event) {
                        $active = '';
                        if ($key == 0)
                            $active = 'active';
                    ?>
                        <div class="carousel-item <?= $active ?>">
                            <img src="<?= base_url('assets/images/client_uploads/') . $event->image ?>" class="d-block landing-page-image" alt="...">

                            <div class="carousel-caption d-none d-md-block info-card">
                                <h4>Evento: <?= $event->title ?></h4>
                                <h5>Data: <?= date('d/m/y', strtotime(str_replace('-', '/', $event->event_date))) ?> às <?= $event->event_hour ?></h5>
                                <p><?= $event->description ?><p>
                            </div>
                        </div>


                    <?php } ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon slide-arrow" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon slide-arrow" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>