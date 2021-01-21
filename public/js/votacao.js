var votacao = {
    dadosValidos: false,
	mensagem: ''
}

votacao.apenasNumeros = function(extra){
	if(window.event){
		if((window.event.keyCode <48) || (window.event.keyCode>57)){
			if(extra == undefined) return false;
			if(extra.indexOf(String.fromCharCode(window.event.keyCode)) < 0) return false;
		}
	}
	return true;
}

votacao.mascaraData = function(campoData){
    var data = campoData.value;
    if(data.length == 2){
        data = data + '/';
        campoData.value = data;
        return true;
    }
    if(data.length == 5){
        data = data + '/';
        campoData.value = data;
        return true;
    }
    if(!isNaN(data) && (data.length == 6 || data.length == 8)){
        campoData.value = data.substr(0,2) + '/' + data.substr(2,2) + '/' + data.substr(4);
    }
}

votacao.mostrarMensagem = function(){
    //Oculta modal, pois o eleitor pode ter tentado concluir, mas tinha erros
    $('#confirmacao').modal('hide');

    //Monta caixa da mensagem
    var caixa = '<div class="row mensagem">';
    caixa+= '<div class="col-xs-12">';
    caixa+= '<div class="alert alert-danger">';
    caixa+= '<button class="close" data-dismiss="alert">';
    caixa+= '<span aria-hidden="true">&times;</span>';
    caixa+= '</button>';
    caixa+= '<p>';
    caixa+= this.mensagem;
    caixa+= '</p>';
    caixa+= '</div>';
    caixa+= '</div>';
    caixa+= '</div>';

    //Insere caixa da mensagem na tela, acima do conteúdo (abaixo do banner do topo)
    $(caixa).insertBefore('#conteudo');

    //Move página para o topo, para que o eleitor possa ver a mensagem
    $("html, body").animate({ scrollTop: 0 }, 500);
};

votacao.solicitarConfirmacao = function(){
    //Guarda que os dados já foram validados
    this.dadosValidos = true;

    //Carrega dados pessoais no modal
    $('#modalCpf').html($('#cpf').val());
    $('#modalNascimento').html($('#nascimento').val());
    $('#modalTelefone').html($('#telefone').val());
    $('#modalNome').html($('#nome').val());
    $('#modalEmail').html($('#email').val());
    $('#modalEndereco').html($('#endereco').val());
    $('#modalBairro').html($('#bairro').val());
    $('#modalCidade').html($('#cidade').val());
    $('#modalUf').html($('#uf').val());

    //Carrega projetos votados no modal
    if($("[name='projeto_inovador']:checked").val() > 0) $('#modalInovador').html($("[name='projeto_inovador']:checked").parent().find('h4').html());
    else $('#modalInovador').html('NENHUMA DAS OPÇÕES');
    if($("[name='projeto_economico']:checked").val() > 0) $('#modalEconomico').html($("[name='projeto_economico']:checked").parent().find('h4').html());
    else $('#modalEconomico').html('NENHUMA DAS OPÇÕES');
    if($("[name='projeto_social']:checked").val() > 0) $('#modalSocial').html($("[name='projeto_social']:checked").parent().find('h4').html());
    else $('#modalSocial').html('Conforme critérios de avaliação, apenas este projeto foi classificado pela Banca Avaliadora.');
    if($("[name='projeto_equipe']:checked").val() > 0) $('#modalEquipe').html($("[name='projeto_equipe']:checked").parent().find('h4').html());
    else $('#modalEquipe').html('NENHUMA DAS OPÇÕES');
    if($("[name='projeto_estagiario']:checked").val() > 0) $('#modalEstagiario').html($("[name='projeto_estagiario']:checked").parent().find('h4').html());
    else $('#modalEstagiario').html('Único projeto inscrito nesta categoria');

    //Exibe caixa de confirmação
    $('#confirmacao').modal();
}

votacao.validarCampos = function(){
    var mensagem = [];
    var projetoSelecionado = false;

    //Verifica se o eleitor preencheu todos os campos pessoais
    if($('#cpf').val().length == 0 || $('#cpf').val().length > 11 || isNaN($('#cpf').val())) mensagem.push('CPF');
    if($('#nascimento').val().length < 8 || $('#nascimento').val().length > 10) mensagem.push('data de nascimento');
    if($('#telefone').val().length < 8 || $('#telefone').val().length > 11 || isNaN($('#cpf').val())) mensagem.push('telefone');
    if($('#nome').val().length == 0 || $('#nome').val().length > 80) mensagem.push('nome');
    if($('#email').val().length == 0 || $('#email').val().length > 120) mensagem.push('e-mail');
    if($('#endereco').val().length == 0 || $('#endereco').val().length > 120) mensagem.push('endereço');
    if($('#bairro').val().length == 0 || $('#bairro').val().length > 60) mensagem.push('bairro');
    if($('#cidade').val().length == 0 || $('#cidade').val().length > 60) mensagem.push('cidade');
    if($('#uf').val().length != 2) mensagem.push('UF');

    //Verifica se ao menos um projeto foi selecionado
    if($("[name='projeto_inovador']:checked").val() > 0) projetoSelecionado = true;
    if($("[name='projeto_economico']:checked").val() > 0) projetoSelecionado = true;
    if($("[name='projeto_social']:checked").val() > 0) projetoSelecionado = true;
    if($("[name='projeto_equipe']:checked").val() > 0) projetoSelecionado = true;
    if($("[name='projeto_estagiario']:checked").val() > 0) projetoSelecionado = true;

    //Não tendo selecionado nenhum projeto, solicita a seleção
    if(!projetoSelecionado) mensagem.push('selecione ao menos 1 projeto')

    //Verifica se há campos inválidos
    if(mensagem.length == 0) return true;

    //Monta mensagem
    this.mensagem = 'Preencha corretamente os campos: <strong>' + mensagem.join(', ') + '</strong>.';

    //Informa que há erros no formulário
    return false;
};

votacao.votar = function(){
    //Remove mensagens anteriores
    $('.mensagem').remove();

	//Valida os campos
    if(!this.validarCampos()){
		//Havendo mensagem, exíbe-a
		if(this.mensagem.length > 0) this.mostrarMensagem();
		return false;
    }

    //Verifica se confirmou os dados
    if(!this.dadosValidos){
        //Solicita confirmação dos dados e votos
        if(!this.solicitarConfirmacao()) return false;
    }

	//Submete formulário
	$('form').submit();

	return true;
};

$(document).ready(function(){
    $("#confirmacao").on('hidden.bs.modal', function () {
        //Ao fechar a janela, força nova confirmação
        votacao.dadosValidos = false;
    });
});
