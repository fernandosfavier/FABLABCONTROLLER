$(document).ready(function() {

    $('#entrar').click(function() {

        if ($('#email').val() === '' || $('#senha').val() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Por favor, preencha todos os campos.',
            });

            return;
        }

        $.ajax({
            url: '../api/login',
            method: 'POST',
            data: {
                email: $('#email').val(),
                password: $('#senha').val()
            },
            success: function(response) {
                if (response.erro == 'n') {
                    alert(response.token);
                    $.cookie('token', response.token, { path: '/' });
                    $.cookie('usuario', response.usuario, { path: '/' });
                    setTimeout(function() {
                        window.location.href = '/agendamento';
                    }, 3000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: response.mensagem,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Não foi possível realizar o login.'
                });
            }
        });

    });

});