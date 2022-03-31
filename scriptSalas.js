update = false;
$('#nome_sala').val('');
$('#serie').val('');
$('#id_sala').val('');

$('#adicionar_sala').val("Salvar");

$('#form_sala').submit(function (event) {
    event.preventDefault();
    nome_sala = $("#nome_sala").val();
    serie = $("#serie").val();
    id_sala = $('#id_sala').val();

    if (update) {
        $.ajax({
            type: "post",
            url: "http://localhost/cadastroAlunosAjax/backend/updateSala.php",
            data: {
                id_sala: id_sala,
                nome_sala: nome_sala,
                serie: serie
            }
        }).done(
            listarSalas()
        );
    } else {
        $.ajax({
            type: "post",
            url: "http://localhost/cadastroAlunosAjax/backend/salvarSala.php",
            data: {
                nome_sala: nome_sala,
                serie: serie,
            },
            dataType: "json",
        }).done(
            listarSalas()
        );
    }
    update = false;
    $('#nome_sala').val('');
    $('#serie').val('');
    $('#id_sala').val('');
    $('#adicionar_sala').val("Salvar");
});

function listarSalas() {
    $('.salas').empty();
    $.ajax({
        url: "http://localhost/cadastroAlunosAjax/backend/buscarSalas.php",
        dataType: "json",
        success: function (response) {
            for (i = 0; i < response.length; i++) {
                $('.salas').append(
                    '<tr><td>' + response[i].nome_sala + '</td>' +
                    '<td>' + response[i].serie + '</td>' +
                    '<td><button onClick="apagarSala(' + response[i].id_sala + ')">Apagar</td>' +
                    '<td><button onClick="editarSala(' + response[i].id_sala + ')">Editar</td></tr>'
                );
            }
        }
    });
}

function apagarSala(id) {
    $.ajax({
        type: "GET",
        url: "http://localhost/cadastroAlunosAjax/backend/apagarSala.php",
        data: {
            id_sala: id
        },
    }).done(
        listarSalas()
    );
}

function editarSala(id) {
    $.ajax({
        type: "post",
        url: "http://localhost/cadastroAlunosAjax/backend/buscarSala.php",
        data: {
            id_sala: id
        },
        success: function (res) {
            $("#id_sala").val(res[0].id_sala);
            $("#nome_sala").val(res[0].nome_sala);
            $("#serie").val(res[0].serie);
        }
    });
    update = true;
    $('#adicionar_sala').val("Alterar");
}

listarSalas();