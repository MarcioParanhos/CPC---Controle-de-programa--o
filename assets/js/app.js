// Excluir carencia pegando ID de referencia e adicionando um link ao modal
const modal = document.querySelector("#ExemploModalCentralizado a")
const modalExcedente = document.querySelector("#ModalDeleteExcedente a")
const modalDeleteUser = document.querySelector("#ExemploModalCentralizadoDeleteUser a")
const modalDeleteSuprimento = document.querySelector("#DeleteSuprimento a")

//Função chamada pelo OnClick no html recebendo um parametro
function abrirModal(id) {

    // Declarando a variavel Link
    let link = "./config/carenciaProcess.php?id=" + id

    // Inserindo um elemento dentro do elemento selecionado com QuerySelector
    modal.setAttribute("href", link)

    //Apos inserir o Href no botão do modal abre o Modal para validação do usuario
    $("#ExemploModalCentralizado").modal({
        show: true
    });
}
function abrirModalSuprimento(id) {

    // Declarando a variavel Link
    let link = "./config/suprimentoProcess.php?id=" + id

    // Inserindo um elemento dentro do elemento selecionado com QuerySelector
    modalDeleteSuprimento.setAttribute("href", link)

    //Apos inserir o Href no botão do modal abre o Modal para validação do usuario
    $("#DeleteSuprimento").modal({
        show: true
    });
}
function abrirModalDeleteUser(id) {

    // Declarando a variavel Link
    let link = "./config/userProcess.php?id=" + id

    // Inserindo um elemento dentro do elemento selecionado com QuerySelector
    modalDeleteUser.setAttribute("href", link)

    //Apos inserir o Href no botão do modal abre o Modal para validação do usuario
    $("#ExemploModalCentralizadoDeleteUser").modal({
        show: true
    });
}

//Função chamada pelo OnClick no html recebendo um parametro
function abrirModalDiary(id) {
    // Declarando a variavel Link
    let link = "./config/diaryProcess.php?id=" + id

    // Inserindo um elemento dentro do elemento selecionado com QuerySelector
    modal.setAttribute("href", link)

    //Apos inserir o Href no botão do modal abre o Modal para validação do usuario
    $("#ExemploModalCentralizado").modal({
        show: true
    });

}

function abrirModalExcedente(id) {
    // Declarando a variavel Link
    let link = "./config/excedentesProcess.php?id=" + id

    // Inserindo um elemento dentro do elemento selecionado com QuerySelector
    modalExcedente.setAttribute("href", link)

    //Apos inserir o Href no botão do modal abre o Modal para validação do usuario
    $("#ModalDeleteExcedente").modal({
        show: true
    });

}

// VALIDA O FORMATO DO TELEFONE
const tel = document.getElementById('tel') // Seletor do campo de telefone
tel.addEventListener('keypress', (e) => mascaraTelefone(e.target.value)) // Dispara quando digitado no campo
tel.addEventListener('change', (e) => mascaraTelefone(e.target.value)) // Dispara quando autocompletado o campo

const mascaraTelefone = (valor) => {
    valor = valor.replace(/\D/g, "")
    valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2")
    valor = valor.replace(/(\d)(\d{4})$/, "$1-$2")
    tel.value = valor // Insere o(s) valor(es) no campo
}
const tel_unidade = document.getElementById('tel_unidade') // Seletor do campo de telefone
tel_unidade.addEventListener('keypress', (e) => mascaraTelefoneUnidade(e.target.value)) // Dispara quando digitado no campo
tel_unidade.addEventListener('change', (e) => mascaraTelefoneUnidade(e.target.value)) // Dispara quando autocompletado o campo

const mascaraTelefoneUnidade = (valor) => {
    valor = valor.replace(/\D/g, "")
    valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2")
    valor = valor.replace(/(\d)(\d{4})$/, "$1-$2")
    tel_unidade.value = valor // Insere o(s) valor(es) no campo
}
const tel_vice_gestor = document.getElementById('tel_vice_gestor') // Seletor do campo de telefone
tel_vice_gestor.addEventListener('keypress', (e) => mascaraTelefoneGestor(e.target.value)) // Dispara quando digitado no campo
tel_vice_gestor.addEventListener('change', (e) => mascaraTelefoneGestor(e.target.value)) // Dispara quando autocompletado o campo

const mascaraTelefoneGestor = (valor) => {
    valor = valor.replace(/\D/g, "")
    valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2")
    valor = valor.replace(/(\d)(\d{4})$/, "$1-$2")
    tel_vice_gestor.value = valor // Insere o(s) valor(es) no campo
}
const tel_vice_gestor_2 = document.getElementById('tel_vice_gestor_2') // Seletor do campo de telefone
tel_vice_gestor_2.addEventListener('keypress', (e) => mascaraTelefoneGestor2(e.target.value)) // Dispara quando digitado no campo
tel_vice_gestor_2.addEventListener('change', (e) => mascaraTelefoneGestor2(e.target.value)) // Dispara quando autocompletado o campo

const mascaraTelefoneGestor2 = (valor) => {
    valor = valor.replace(/\D/g, "")
    valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2")
    valor = valor.replace(/(\d)(\d{4})$/, "$1-$2")
    tel_vice_gestor_2.value = valor // Insere o(s) valor(es) no campo
}

// vizualizar modal com dados unicos
function modalExcedentes(id) {
    id = id

    let dados = { id: id }

    $.post('./config/excedentesProcess.php', dados, function (retorno) {

        $('#ExemploModalCentralizado2').modal('show')
        $('#modal_body').html(retorno)

    })
}

function modalUser(id) {
    id = id

    let dados = { id: id }

    $.post('./config/userProcess.php', dados, function (retorno) {

        $('#ExemploModalCentralizadoUser').modal('show')
        $('#modal_body').html(retorno)

    })
}

