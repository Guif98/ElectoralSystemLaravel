let ativo = document.querySelector('.ativo-checkbox');
let selector = document.querySelector('.selector');
let projeto = document.querySelector('.project-div');
var title = document.querySelector('.title');

function apenasNumeros(extra){
	if(window.event){
		if((window.event.keyCode <48) || (window.event.keyCode>57)){
			if(extra == undefined) return false;
			if(extra.indexOf(String.fromCharCode(window.event.keyCode)) < 0) return false;
		}
	}
	return true;
}


/*Código JQuery para a view home**/

let projectDiv = document.querySelectorAll('.project-div');
/**Condição para verificar se os candidatos estão setados e com isso disponibilizar as respectivas funcoes */

let categorias = document.querySelectorAll('.categoria');


    categorias.forEach(function(categoria) {
        if (categoria.childElementCount <= 3) {
            categoria.classList.add('d-none');
        }
    });



if (projectDiv.length > 0) {

        document.getElementById('voto').classList.remove('d-none');
        $(".titulo-projeto").removeClass('d-none');
       /* setTimeout(function() {
            $("#votoModal").modal("show");
        }, 100);

        $("#votoModal").modal({
            backdrop: 'static',
            keyboard: false
        });*/

    setTimeout(function(){
        $("#msg-session").fadeOut('fast');
        $("#msg-error-request").fadeOut('fast');
     }, 3000 );


    $("#confirmar").click(function() {
        if (document.getElementById("nome").value) {
            if (document.getElementById("sobrenome").value) {
                if (document.getElementById("cpf").value) {
                    let projetos = []
                    let votados = document.querySelectorAll(".selected");
                    let votadosNome = votados.forEach(function (nomes) {
                        projetos.push(nomes.getElementsByTagName('h4'))
                    });

                    $("#votoModal").modal('hide');
                    $("#descricaoModal").modal('show');

                    document.getElementById('descricao').innerHTML = `<p><b>Nome:</b> ${nome.value}</p>
                    <p><b>Sobrenome:</b> ${sobrenome.value}</p>
                    <p><b>Cpf:</b> ${cpf.value}</p>
                    <p><b>Projetos Votados:</b></p>`


                    let projetosMapped = projetos.map(function(element) {


                    return `<ul><li>${element[0].textContent}</li></ul>`



                    });

                    /*document.getElementById("descricao").innerHTML = `<p><b>Nome:</b> ${nome.value}</p>
                    <p><b>Sobrenome:</b> ${sobrenome.value}</p>
                    <p><b>Cpf:</b> ${cpf.value}</p>
                    <p><b>Projetos Votados:</b> ${element}</p>
                    `*/

                    $('#descricaoModal').modal('show');
                    document.getElementById('descricao').innerHTML += projetosMapped.join('\n');


                }
            }
        }
    });

    //projeto.children[1].childNodes.item(1).textContent


    /**Evento que e ativado quando o botao votar receber o click */
    $("#voto").click(function() {
            let mensagem = document.getElementById("mensagem-erro");
            let nome =  document.getElementById("nome").value;
            let sobrenome =  document.getElementById("sobrenome").value;
            let cpf =  document.getElementById("cpf").value;
            let projetoVotado = document.querySelectorAll(".selected");
            let projeto = [];



        /**Condicao que verifica se o usuario setou seu nome e suas informacoes */
        if (nome.length > 1 && sobrenome.length > 1 && cpf.length == 11) {
            projetoVotado.forEach(function(p) {
                projeto.push(p.children[1].firstElementChild.textContent
                );
            });

            console.log(projeto);

            /**Alert para verificar se o usuario selecionou um candidato/projeto */
            if (projeto.length == 0) {
                    $("#votoModal").modal("show");
                    mensagem.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Você deve selecionar no mínimo um projeto!</strong>
                      </div>`
                } /*else {
                    $("#descricaoModal").modal('show');
                    document.getElementById("descricao").innerHTML = `<p><b>Nome:</b> ${nome}</p>
                    <p><b>Sobrenome:</b> ${sobrenome}</p>
                    <p><b>Cpf:</b> ${cpf}</p>
                    <p><b>Projetos Votados:</b> ${projeto.toString()}</p>
                    `
                }*/

        /**Alert para quando o usuario nao preencher suas informacoes*/
        } else {
                $("#votoModal").modal("show");
                mensagem.innerHTML = `
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Por favor preencha suas informações corretamente!</strong>
                </div>`
        }
    });

    /**Evento para quando um candidato recebe o click */

    $(".project-div").click(
        function(event)
    {
        $(this).parent().find('.radio').parent().children('input').attr('name', 'selecionada[]');
        $(this).parent().find('.radio').parent().addClass('selecionada');
        $(this).addClass("bg-dark").addClass("text-light").siblings().removeClass("bg-dark").removeClass("text-light");
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
        $(this).children('input').attr('name', 'voto[]');
        $(this).children('input').parent().siblings('div').children('input').removeAttr('name');
    }
    );

    /**Funcao foreach para verificar se o nulo possui apenas um sibling, caso tenha este sibling
     * sera selecionado
     */

    $(".nulo").each(function() {

        if ($(this).siblings().length <= 3) {

            if ($(this).siblings('div').hasClass("radio")) {
                let winner = $(this).siblings('div')[1];

                $(this).text('');
                $(this).append('<h5>Por não haver outro candidato concorrente, este projeto venceu esta categoria.</h5>');
                $(this).removeClass("nulo").addClass("winner");
            }
        }

        }
    )

    /** Evento para quando o nulo receber o click*/

    $(".nulo").click(
        function(event)
    {
        $(this).parent().removeClass('selecionada');
        $(this).parent().children('input').removeAttr('name');
        $(this).addClass("bg-dark").addClass("text-light").siblings().removeClass("bg-dark");
        $(this).parent().find('.radio').removeClass('selected');
        $(this).siblings('div').children('input').removeAttr('name');
    }
    );

/**Else para quando os candidatos não forem setados*/

} else {
    document.getElementById('voto').classList.add('d-none');
    document.getElementById('evento-alert').classList.remove('d-none');
    $(".categoria").addClass('d-none');
    $(".titulo-projeto").removeClass('d-block');
    $("#votoModal").modal("hide");
    $("#ver_resultado_div").removeClass('d-none');
}
