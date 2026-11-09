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
        
    });
});