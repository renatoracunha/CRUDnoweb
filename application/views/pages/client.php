<div class="main">
    <div class="container">
        <div class="row main-card">
            <?php foreach ($events as $event) : ?>
                <div class="row">
                    <div class="col-6 col-md-3">
                        <img class="mr-3 event-list-image" src="<?= base_url('assets/images/client_uploads/') . $event->image ?>" alt="event title">
                    </div>
                    <div class="col-6 col-md-9">
                        <h5>Evento: <?= $event->title ?> Data: <?= $event->event_date ?> às <?= $event->event_hour ?></h5>
                        <?= $event->description ?>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>