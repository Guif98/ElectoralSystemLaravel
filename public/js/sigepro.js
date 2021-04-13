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
        setTimeout(function() {
            $("#votoModal").modal("show");
        }, 100);

        $("#votoModal").modal({
            backdrop: 'static',
            keyboard: false
        });

        let imageContainers = document.querySelectorAll('.image-container');
        imageContainers.forEach(function(imageContainer){
            if (imageContainer.childElementCount == 0) {
                imageContainer.previousElementSibling.childNodes[7].classList.remove('ver_fotos')
                imageContainer.previousElementSibling.childNodes[7].classList.add('d-none')
            }
        });
    setTimeout(function(){
        $("#msg-session").fadeOut('fast');
        $("#msg-error-request").fadeOut('fast');
     }, 3000 );

    /**Evento ativado quando o usuario clickar em alguma imagem na versao desktop */
    $(".img").click(function() {

        var index = 0;
        let currentImg = document.getElementById(this.id);
        let parentDiv = currentImg.parentNode.parentNode.parentNode;

        let siblingImages = parentDiv.getElementsByTagName('img');

        for (let i=0; i < siblingImages.length; i++) {
            siblingImages[i].onclick = function(index) {
                index = i;

        $("#imgModal").modal();
        let imageInsideModal = document.getElementById("imageInsideModal");
        let imgSrc = siblingImages[index].currentSrc;
        imageInsideModal.src = imgSrc;

        }
    }

    /**Evento ativado quando o usuario clickar na seta para frente na versao desktop */
     $("#proximo").click(function () {
            index++;
            if (index > siblingImages.length - 1 || index > 3 ) {
                index = 0;
                imgSrc = siblingImages[0].currentSrc;
                imageInsideModal.src = imgSrc;
                return imageInsideModal.src;
            }

            else if (index < 0) {
                index = 0;
                imgSrc = siblingImages[0].currentSrc;
                imageInsideModal.src = imgSrc;
                return imageInsideModal.src;
            }
            imgSrc = siblingImages[index].currentSrc;
            imageInsideModal.src = imgSrc;
     });

     /**Evento ativado quando o usuario clickar na seta para tras na versao desktop */
        $("#anterior").click(function() {
            index--;
            if (index < 0) {
                if (siblingImages.length > 4) {
                    index = 3;
                    imgSrc = siblingImages[3].currentSrc;
                    imageInsideModal.src = imgSrc;
                    return imageInsideModal.src;
                } else {
                    index = siblingImages.length - 1;
                    imgSrc = siblingImages[siblingImages.length - 1].currentSrc;
                    imageInsideModal.src = imgSrc;
                    return imageInsideModal.src;
                }

            }
            else if (index > siblingImages.length - 1 || index == 3) {
                index = siblingImages.length - 1;
                imgSrc = siblingImages[siblingImages.length - 1].currentSrc;
                imageInsideModal.src = imgSrc;
                return imageInsideModal.src;
            }
            imgSrc = siblingImages[index].currentSrc;
            imageInsideModal.src = imgSrc;
        });
    });

    /**Evento para quando o usuario preencher corretamente suas informacoes e confirmar no
     * modal inicial
     */
    $("#confirmar").click(function() {
        if (document.getElementById("nome").value) {
            if (document.getElementById("sobrenome").value) {
                if (document.getElementById("cpf").value) {
                    $("#votoModal").modal('hide');
                }
            }
        }
    });


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

            /**Alert para verificar se o usuario selecionou um candidato/projeto */
            if (projeto.length == 0) {
                    $("#votoModal").modal("show");
                    mensagem.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Você deve selecionar no mínimo um projeto!</strong>
                      </div>`
                } else {
                    $("#descricaoModal").modal('show');
                    document.getElementById("descricao").innerHTML = `<p><b>Nome:</b> ${nome}</p>
                    <p><b>Sobrenome:</b> ${sobrenome}</p>
                    <p><b>Cpf:</b> ${cpf}</p>
                    <p><b>Projetos Votados:</b> ${projeto.toString()}</p>
                    `
                }

        /**Alert para quando o usuario nao preencher suas informacoes*/
        } else {
                $("#votoModal").modal("show");
                mensagem.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Você deve preencher suas informações corretamente!</strong>
                </div>`
        }
    });

    /**Funcao para quando o botao Ver Fotos, presente na versao mobile, receber o click */

    $(".ver_fotos").click(function() {
        let n = 0;
        let fotos = this.parentElement.parentElement.children[2].getElementsByTagName('img');
        $("#imgModalSmartphone").modal("show")
        document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[n].currentSrc}" style="width: 100%;">`

        /**Evento para quando a seta para frente receber o click na versao mobile */

        $("#next").click(function(){
             n++;
            if (n > fotos.length - 1) {
                n = fotos.length - 1;
                return document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[fotos.length - 1].currentSrc}" style="width: 100%;">`
            } else {
                return document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[n].currentSrc}" style="width: 100%;">`
            }
        });

        /**Evento para quando a seta para tras receber o click na versao mobile*/

        $("#prev").click(function(){
            n--;
            if (n <= 0) {
                n = 0
                return document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[0].currentSrc}" style="width: 100%;">`
            } else {
                return document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[n].currentSrc}" style="width: 100%;">`
            }
        });
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
