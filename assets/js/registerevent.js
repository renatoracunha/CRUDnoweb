function register(base_url) {
    //return console.log($('#imagem'));
    let event_title = $('#event_title').val();
    let event_address = $('#event_address').val();
    let event_date = $('#event_date').val();
    let event_hour = $('#event_hour').val();
    let event_image = $('#event_image').val();
    let event_description = $('#event_description').val();

    if (event_title == '') {
        $('#event_title').addClass('is-invalid');
        $('#event_title').focus();
        $('#event_title').attr('placeholder', 'Informe um título ao evento');
        $('#event_title').css("background-color", "#FFD6D6");
        return;
    }

    if (event_address == '') {
        $('#event_address').addClass('is-invalid');
        $('#event_address').focus();
        $('#event_address').attr('placeholder', 'Informe um endereço ao evento');
        $('#event_address').css("background-color", "#FFD6D6");
        return;
    }
    if (event_date == '') {
        $('#event_date').addClass('is-invalid');
        $('#event_date').focus();
        //$('#event_date').attr('placeholder', 'Informe um event_date');
        alert('Informe uma data ao evento');
        $('#event_date').css("background-color", "#FFD6D6");
        return;
    }
    if (event_hour == '') {
        $('#event_hour').addClass('is-invalid');
        $('#event_hour').focus();
        alert('Informe uma hora para evento');
        $('#event_hour').css("background-color", "#FFD6D6");
        return;
    }
    if (event_image == '') {
        $('#event_image').addClass('is-invalid');
        $('#event_image').focus();
        alert('Escolha uma imagem para o evento');
        $('#event_image').css("background-color", "#FFD6D6");
        return;
    }
    if (event_description == '') {
        $('#event_description').addClass('is-invalid');
        $('#event_description').focus();
        $('#event_description').attr('placeholder', 'Informe uma descrição para o evento');
        $('#event_description').css("background-color", "#FFD6D6");
        return;
    }
    import ('./noweb.js').then(module => {
        module.clear_invalid_fields();
    });

    $.ajax({
        url: base_url + "index.php/main/ajax_register_event",
        dataType: "json",
        type: "get",
        data: { event_title: event_title, event_address: event_address, event_date: event_date, event_hour: event_hour, event_image: event_image, event_description: event_description },
        cache: false,
        success: function(data) {
            //console.log(data);
            if (data) {
                alert('Evento cadastrado com sucesso');
                document.getElementById("register_event_form").submit();
            } else {
                alert('error, procurar equipe de desenvolvimento');
            }
        },
        error: function(e) {
            alert('erro');
        }
    })
}