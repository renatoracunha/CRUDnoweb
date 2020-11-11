function delete_event(base_url, event_id, event_status) {
    if (event_status > 0) {
        return alert('Não é possível deletar um evento ativo');
    }
    $.ajax({
        url: base_url + "index.php/main/ajax_delete_event",
        dataType: "json",
        type: "post",
        data: { event_id: event_id },
        cache: false,
        success: function(data) {
            if (data) {
                location.reload();
            } else {
                alert('Erro, procurar setor de desenvolvimento');
            }
        },
        error: function(e) {
            alert('error');
        }
    })
}

function status_event(base_url, event_id, status) {
    $.ajax({
        url: base_url + "index.php/main/ajax_status_event",
        dataType: "json",
        type: "post",
        data: { event_id: event_id, status: status },
        cache: false,
        success: function(data) {
            if (data) {
                if (status == 1) {
                    $('#span_status_' + event_id).html('<button type="button" title="Desativar Evento" onclick=\'status_event("' + base_url + '",' + event_id + ',0)\' class="btn btn-options btn-danger"><span class="fa fa-remove"></button>')
                } else {
                    $('#span_status_' + event_id).html('<button type="button" title="Ativar Evento" onclick=\'status_event("' + base_url + '",' + event_id + ',1)\' class="btn btn-options btn-success"><span class="fa fa-check"></button>')
                }
            } else {
                alert('Erro, procurar setor de desenvolvimento');
            }
        },
        error: function(e) {
            alert('error');
        }
    })
}

function edit_event(base_url, event_id) {
    window.location.href = base_url + "index.php/main/view/editevent/" + event_id;
}