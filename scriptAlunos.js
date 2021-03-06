update = false;
$('#nome').val('');
$('#idade').val('');
$('#cpf').val('');
$('#id').val('');

if (update) {
    $('#botao').val("Alterar");
} else {
    $('#botao').val("Adicionar");
}

$('#formAluno').submit(function (event) {
    event.preventDefault();
    nomeAluno = $('#nome').val();
    idadeAluno = $('#idade').val();
    cpfAluno = $('#cpf').val();
    id = $('#id').val();
    id_sala = $('#select_sala').val();

    // alterar aluno
    if (update) {
        $.ajax({
            type: "post",
            url: "/cadastroalunos/controllers/Controller_aluno.php/updateAluno",
            data: {
                nome: nomeAluno,
                idade: idadeAluno,
                cpf: cpfAluno,
                id: id,
                id_sala: id_sala
            },
            complete: function(){
                listarAlunos()
            }
        });
        // adicionar aluno
    } else {
        $.ajax({
            type: "post",
            url: "/cadastroalunos/controllers/Controller_aluno.php/salvarAluno",
            data: {
                nome: nomeAluno,
                idade: idadeAluno,
                cpf: cpfAluno,
                id_sala: id_sala
            },
            dataType: "json",
            complete: function(){
                listarAlunos();
            }
        })
    }

    $('#id').val('');
    $('#nome').val('');
    $('#idade').val('');
    $('#cpf').val('');
    update = false;
    $('#botao').val("Adicionar");
});

// apagar aluno
function apagarAluno(id) {
    $.ajax({
        url: "/cadastroalunos/controllers/Controller_aluno.php/apagarAluno",
        type: "POST",
        data: {
            id: id,
        },
        complete: function (response) {
            listarAlunos();
        },
        fail: function (response) {
            alert("Erro ao apagar");
        }
    })
}

// buscar lista de alunos
function listarAlunos() {
    $('.alunos').empty();
    $.ajax({
        url: "/cadastroalunos/controllers/Controller_aluno.php/buscarAlunos",
        success: function (response) {
            for (i = 0; i < response.length; i++) {
                $('.alunos').append(
                    '<tr><td>' + response[i].nome + '</td>' +
                    '<td>' + response[i].idade + '</td>' +
                    '<td>' + response[i].cpf + '</td>' +
                    '<td>' + response[i].nome_sala + '</td>' +
                    '<td>' + response[i].serie + '</td>' +
                    '<td><button onClick="apagarAluno(' + response[i].id + ')">Apagar</td>' +
                    '<td><button onClick="editarAluno(' + response[i].id + ')">Editar</td></tr>'
                );
            }
        }
    });
    selectSalas();
}

// buscar lista de salas
function selectSalas() {
    $.ajax({
        url: "/cadastroalunos/controllers/Controller_sala.php/buscarSalas",
        success: function (response) {
            $('#select_sala').empty();
            for (i = 0; i < response.length; i++) {
                $('#select_sala').append(
                    '<option value=\"' + response[i].id_sala + '\">' + response[i].nome_sala + '</option>'
                );
            }
        }
    });
}

function editarAluno(id) {
    $.ajax({
        type: 'post',
        url: "/cadastroalunos/controllers/Controller_aluno.php/buscarAluno",
        data: {
            id: id
        },
        success: function (res) {
            $('#id').val(res[0].id);
            $('#nome').val(res[0].nome);
            $('#idade').val(res[0].idade);
            $('#cpf').val(res[0].cpf);
        }
    });
    
    $('#botao').val("Alterar");
    update = true;
}

listarAlunos();