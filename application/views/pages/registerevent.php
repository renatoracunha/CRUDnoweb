<div class="main">
    <div class="container">
        <form id="register_event_form" method="POST" action="<?php echo site_url('main/upload_image'); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="event_title">Titulo do Evento</label>
                <input type="text" class="form-control" id="event_title" placeholder="Evento...">
            </div>
            <div class="form-group">
                <label for="event_address">Endereço</label>
                <input type="text" class="form-control" id="event_address" placeholder="Av. Paulista, 144...">
            </div>
            <div class="form-row">
                <div class="form-group col-12 col-md-4">
                    <label for="event_date">Data do Evento</label>
                    <input type="date" class="form-control" id="event_date">
                </div>
                <div class="form-group col-12 col-md-4">
                    <label for="event_hour">Hora do Evento</label>
                    <input type="time" class="form-control" id="event_hour">
                </div>
                <div class="form-group col-12 col-md-4 align-self-end">
                    <label for="event_image" class="file-label">Imagem do Evento <span class="fa fa-upload"></span></label>
                    <input type="file" name="event_image" class="d-none" accept="image/png, image/jpeg" id="event_image">
                </div>
            </div>
            <div class="form-group">
                <label for="event_description">Descrição</label>
                <input type="text" class="form-control" id="event_description" placeholder="Evento geek a noite...">
            </div>
            <button type="button" onclick='register("<?= base_url() ?>")' class="btn btn-dark">Cadastrar</button>
        </form>
        <script src="<?= base_url('assets/js/registerevent.js') ?>"></script>