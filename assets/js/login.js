function verify_login(base_url) {
    let username = $('#username').val();
    let password = $('#password').val();

    if (username == '') {
        $('#username').addClass('is-invalid');
        $('#username').focus();
        $('#username').attr('placeholder', 'Informe um username');
        $('#username').css("background-color", "#FFD6D6");
        return alert('Preencha o nome de usuário');
    }
    if (password == '') {
        $('#password').addClass('is-invalid');
        $('#password').focus();
        $('#password').attr('placeholder', 'Informe uma senha');
        $('#password').css("background-color", "#FFD6D6");
        return alert('Preencha a senha');
    }
    $.ajax({
        url: base_url + "index.php/main/ajax_get_user_data",
        dataType: "json",
        type: "post",
        data: { password: password, username: username },
        cache: false,
        success: function(data) {
            if (data.status) {

                window.location.href = base_url + "index.php/main/view/client";
            } else {
                alert(data.msg);
            }
        },
        error: function(e) {
            alert('error');
        }
    })
}