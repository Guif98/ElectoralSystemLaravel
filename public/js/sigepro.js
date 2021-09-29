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

function arquivosSelecionados(event) {
    const files = event.target.files;
    const label = document.getElementById('label-foto');
    const arr = [];
    label.innerHTML = 'Imagens selecionadas: ';
    for (let i=0; i < files.length; i++) {
         arr.push(files[i].name);
    }
    label.innerHTML += arr.join(', ')
}

/*Código JQuery para a view home**/

let projectDiv = document.querySelectorAll('.project-div');
/**Condição para verificar se os candidatos estão setados e com isso disponibilizar as respectivas funcoes */

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

                        if (projetos.length > 0) {
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

                    } else {
                        alert('Você deve selecionar no mínimo um projeto antes de confirmar suas informações!')
                        $("#votoModal").modal("hide");
                        mensagem.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <strong>Você deve selecionar no mínimo um projeto!</strong>
                          </div>`
                    }
                }
                else {
                    alert('Preencha o campo CPF')
                }
            }
            else {
                alert('Preencha o campo Sobrenome')
            }
        }
        else {
            alert('Preencha o campo Nome')
        }
    });

    //projeto.children[1].childNodes.item(1).textContent


    /**Evento que e ativado quando o botao votar receber o click */
    $("#voto").click(function() {
            if ($("#votoModal").modal('hide')) {
                $("#votoModal").modal('show')
            }


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
                }
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
        if(!event.target.classList.contains('imgProjeto')) {
        const display = $(this).find('.project-content').css('display');
        if (display == 'none')
            $(this).find('.project-content').css('display', 'flex').css('flex-direction', 'column');
        else
            $(this).find('.project-content').css('display', 'none');

        $(this).parent().find('.radio').parent().children('input').attr('name', 'selecionada[]');
        $(this).parent().find('.radio').parent().addClass('selecionada');
        $(this).addClass("bg-dark").addClass("text-light").siblings().removeClass("bg-dark").removeClass("text-light");
        $(this).find('span').css('filter', 'brightness(0) invert(1)');
        $(this).find('.expand_more_image').toggleClass('flip');
        $(this).siblings().find('span').css('filter', 'brightness(0%)');
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
        $(this).children('input').attr('name', 'voto[]');
        $(this).children('input').parent().siblings('div').children('input').removeAttr('name');
        }
    }
    );

    /**Funcao foreach para verificar se o nulo possui apenas um sibling, caso tenha este sibling
     * sera selecionado
     */



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
