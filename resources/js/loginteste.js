
$(document).ready(function() {

    $('#entrar').click(function() {

        if ($('#email').val() === '' || $('#senha').val() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Por favor, preencha todos os campos.'
            });

            return;
        }

        $.ajax({
            url: '/api/login',
            method: 'POST',
            data: {
                email: $('#email').val(),
                senha: $('#senha').val()
            },

            success: function(response) {

                if (response.erro == 'n') {

                    $.cookie('token', response.token, {
                        path: '/',
                        expires: 7
                    });

                    $.cookie('usuario_id', response.usuario_id, {
                        path: '/',
                        expires: 7
                    });

                    setTimeout(function(){
                         window.location.href = '/home';
                    },3000);

                   

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: response.message
                    });
                }
            },

            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: xhr.responseJSON?.message || 'Não foi possível realizar o login.'
                });
            }
        });
    });

});
