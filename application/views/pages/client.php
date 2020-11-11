<div class="main">
    <div class="container">
        <br>
        <div class="row main-card align-items-center">
            <?php foreach ($events as $event) : ?>
                <div class="col-6 col-md-3">
                    <img class="event-list-image" src="<?= base_url('assets/images/client_uploads/') . $event->image ?>" alt="event title">
                </div>
                <div class="col-6 col-md-6">
                    <h4>Evento: <?= $event->title ?></h4>
                    <h5>Data: <?= date('d/m/y', strtotime(str_replace('-', '/', $event->event_date))) ?> às <?= $event->event_hour ?></h5>
                    <?= $event->description ?>
                </div>
                <div class="col-12 col-md-3 ">
                    <span id="span_status_<?= $event->id ?>">

                        <?php if ($event->status > 0) { ?>
                            <button type="button" title="Desativar Evento" onclick='status_event("<?= base_url() ?>",<?= $event->id ?>,0)' class="btn btn-options btn-danger"><span class="fa fa-remove"></button>
                        <?php } else { ?>
                            <button type="button" title="Ativar Evento" onclick='status_event("<?= base_url() ?>",<?= $event->id ?>,1)' class="btn btn-options btn-success"><span class="fa fa-check"></button>
                        <?php } ?>

                    </span>
                    <button type="button" title="Editar Evento" onclick='edit_event("<?= base_url() ?>",<?= $event->id ?>)' class="btn btn-options btn-primary"><span class="fa fa-edit"></button>
                    <button type="button" title="Remover Evento" onclick='delete_event("<?= base_url() ?>",<?= $event->id ?>,<?= $event->status ?>)' class="btn btn-options btn-danger"><span class="fa fa-trash"></button>
                </div>
            <?php endforeach; ?>

        </div>
        <script src="<?= base_url('assets/js/client.js') ?>"></script>