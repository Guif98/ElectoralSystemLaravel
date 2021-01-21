@extends('layouts.template')


<form method="post" action="{{route('/')}}">
    @method('post')
    @csrf
    <fieldset>
        <legend>Dados pessoais</legend>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <label for="cpf">CPF <small>(apenas números)</small></label>
                    <input class="form-control" id="cpf" maxlength="11" name="cpf" onkeypress="return votacao.apenasNumeros();" placeholder="Ex.: 12345678901" type="text" value="">
                </div><!-- .form-group -->
            </div><!-- .col-xs-12 .col-sm-4 -->
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <label for="nascimento">Data de nascimento</label>
                    <input class="form-control" id="nascimento" maxlength="10" name="nascimento" onkeypress="votacao.mascaraData(this); return votacao.apenasNumeros();" onblur="votacao.mascaraData(this)" placeholder="Ex.: 01/01/2018" type="text" value="">
                </div><!-- .form-group -->
                </div><!-- .col-xs-12 .col-sm-4 -->
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <label for="telefone">Telefone <small>(apenas números)</small></label>
                    <input class="form-control" id="telefone" maxlength="11" name="telefone" onkeypress="return votacao.apenasNumeros();" placeholder="Ex.: 34338100" type="text" value="">
                </div><!-- .form-group -->
            </div><!-- .col-xs-12 .col-sm-4 -->
        </div><!-- .row -->
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="nome">Nome completo</label>
                    <input class="form-control" id="nome" maxlength="80" name="nome" placeholder="Nome Completo" type="text" value="">
                </div><!-- .form-group -->
            </div><!-- .col-xs-12 .col-sm-6 -->
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" id="email" maxlength="120" name="email" placeholder="Ex.: nome@dominio.com.br" type="text" value="">
                </div><!-- .form-group -->
            </div><!-- .col-xs-12 .col-sm-6 -->
        </div><!-- .row -->
        <div class="row">
            <div class="col-xs-12 col-lg-5">
                <div class="form-group">
                    <label for="endereco">Endereço <small>(Logradouro, nº, comp.)</small></label>
                    <input class="form-control" id="endereco" maxlength="120" name="endereco" placeholder="Ex.: Rua Engenheiro Hener de Souza Nunes, 150" type="text" value="">
                </div><!-- .form-group -->
            </div><!-- .col-xs-12 .col-lg-5 -->
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input class="form-control" id="bairro" maxlength="60" name="bairro" placeholder="Ex.: São Sebastião" type="text" value="">
                </div><!-- .form-group -->
            </div><!-- .col-xs-12 .col-md-6 .col-lg-3 -->
            <div class="col-xs-12 col-sm-10 col-md-5 col-lg-3">
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input class="form-control" id="cidade" maxlength="60" name="cidade" placeholder="Ex.: Esteio" type="text" value="">
                </div><!-- .form-group -->
            </div><!-- .col-xs-12 .col-sm-10 .col-md-5 .col-lg-3 -->
            <div class="col-xs-12 col-sm-2 col-md-1">
                <div class="form-group">
                    <label for="uf">UF</label>
                    <input class="form-control" id="uf" maxlength="2" name="uf" placeholder="RS" type="text" value="">
                </div><!-- .form-group -->
            </div><!-- .col-xs-12 .col-sm-2 .col-md-1 -->
        </div><!-- .row -->
    </fieldset>
    <fieldset>
        <legend>Projetos finalistas</legend>
        <div class="row">
            <div class="bg-primary col-xs-12">
                <h3 class="text-center">Ação Inovadora</h3>
            </div><!-- .bg-primary .col-xs-12 -->
        </div><!-- .row -->
        <div class="row">
            <div class="col-xs-12 projetoConteudo">
                <div class="radio">
                    <label>
                        <input id="projeto_inovador_1" name="projeto_inovador" type="radio" value="1">
                        <h4>Regulação da fila de espera para atendimento das consultas de Nutrição.</h4>
                        <h5>Mari Rosangela Nunes (SMS)</h5>
                        <p class="text-justify">Diante da alta demanda de consultas de nutrição, para redução de peso, existe uma grande fila de espera. Com intuito de reduzir o tempo para atendimento e aumentar a disponibilidade de consultas, para pacientes com sobrepeso e obesidade, foi elaborado um sistema de atendimento mensal, em  grupo , com critérios de prioridades. Resultados : Redução de 33% no tempo da fila de espera. Aumento de 52%  no número de atendimentos.</p>
                    </label>
                    <div>
                        <a href="{{url('/storage/fotos/inovador_1_1.jpg')}}" data-lightbox="inovador_1"><img class="img" src="{{url('/storage/fotos/inovador_1_1.jpg')}}" ></a><a href="{{url('/storage/fotos/g/inovador_1_2.jpg')}}" data-lightbox="inovador_1"><img class="img" src="{{url('/storage/fotos/inovador_1_2.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_1_3.jpg')}}" data-lightbox="inovador_1"><img class="img" src="{{url('storage/fotos/inovador_1_3.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_1_4.jpg')}}" data-lightbox="inovador_1"><img class="img" src="{{url('storage/fotos/inovador_1_4.jpg')}}" ></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio">
                    <label>
                        <input id="projeto_inovador_2" name="projeto_inovador" type="radio" value="2">
                        <h4>Melhorias no setor de bem-estar animal</h4>
                        <h5>Luciane Baretta (SMMA)</h5>
                        <p class="text-justify">Ao assumir o setor de Bem-Estar Animal que encontrava-se em situação caótica, foi dedicado intenso trabalho de melhorias, entre elas: humanização do ambiente de trabalho para os servidores; elaboração de protocolos de limpeza, organização do canil, ambulatório, sede administrativa, atendimentos a pequenos animais e equinos, castrações e fiscalizações; aproximação com empresas e ONGs do município buscando melhorias; promoção do bem-estar animal (Shower Day, adoções, rodízio de passeios).</p>
                    </label>
                    <div>
                        <a href="{{url('storage/fotos/g/inovador_2_4.jpg')}}" data-lightbox="inovador_2"><img class="img" src="{{url('storage/fotos/inovador_2_4.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_2_1.jpg')}}" data-lightbox="inovador_2"><img class="img" src="{{url('storage/fotos/inovador_2_1.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_2_2.jpg')}}" data-lightbox="inovador_2"><img class="img" src="{{url('storage/fotos/inovador_2_2.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_2_3.jpg')}}" data-lightbox="inovador_2"><img class="img" src="{{url('storage/fotos/inovador_2_3.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_2_5.jpg')}}" data-lightbox="inovador_2"><img class="img" src="{{url('storage/fotos/inovador_2_5.jpg')}}" ></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio">
                    <label>
                        <input id="projeto_inovador_3" name="projeto_inovador" type="radio" value="3">
                        <h4>Tratamento Antitabagismo sob o olhar da auriculoterapia como método terapêutico complementar na ESF Planalto</h4>
                        <h5>Rosane C. Bordinhão (SMS)</h5>
                        <p class="text-justify">Segundo a Organização Mundial da Saúde o tabagismo é a principal causa de morte evitável  no mundo, e um grande problema de saúde pública. O município de Esteio aderiu ao Programa Nacional de Controle ao Tabagismo, pois contribuir para um indivíduo parar de fumar é uma das práticas mais benéficas que um profissional de saúde pode realizar. Visto que, cessar o tabagismo significa aumentar a qualidade de vida do usuário, apostando na Auriculoterapia como uma prática complementar ao tratamento.</p>
                    </label>
                    <div>
                        <a href="{{url('storage/fotos/g/inovador_3_1.jpg')}}" data-lightbox="inovador_3"><img class="img" src="{{url('storage/fotos/inovador_3_1.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_3_2.jpg')}}" data-lightbox="inovador_3"><img class="img" src="{{url('storage/fotos/inovador_3_2.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_3_3.jpg')}}" data-lightbox="inovador_3"><img class="img" src="{{url('storage/fotos/inovador_3_3.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_3_4.jpg')}}" data-lightbox="inovador_3"><img class="img" src="{{url('storage/fotos/g/inovador_3_4.jpg')}}" ></a><a href="{{url('storage/fotos/g/inovador_3_5.jpg')}}" data-lightbox="inovador_3"><img class="img" src="{{url('storage/fotos/g/inovador_3_5.jpg')}}" ></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio">
                    <label>
                        <br>
                        <input id="projeto_inovador_4" name="projeto_inovador" type="radio" value="">
                        <h4>NENHUMA DAS OPÇÕES ACIMA</h4>
                    </label>
                </div><!-- .radio -->
            </div><!-- .cols-xs-12 -->
        </div><!-- .row -->

        <div class="row">
            <div class="bg-primary col-xs-12">
                <h3 class="text-center">Sustentabilidade Econômica</h3>
            </div><!-- .bg-primary .col-xs-12 -->
        </div><!-- .row -->
        <div class="row">
            <div class="col-xs-12 projetoConteudo">
                <div class="radio">
                    <label>
                        <input id="projeto_economico_1" name="projeto_economico" type="radio" value="4">
                        <h4>Reciclando em forma de arte: nós brincamos, economizamos e a natureza agradece</h4>
                        <h5>Sandra Pivato (SME)</h5>
                        <p class="text-justify">Pensando em economia de recursos financeiros e também ações de cuidado com o meio ambiente, realizou-se o projeto “Reciclando em forma de arte”, com os alunos do 1º ano da EMEB Vitorina Fabre. O reaproveitamento de materiais é muito rico para construir brinquedos e jogos pedagógicos, servindo de incentivo para confeccionar produtos de baixo custo e de forma criativa, além de incentivar o cuidado com a natureza. A escola economizou e os alunos foram protagonistas desta redução de custos.</p>
                    </label>
                    <div>
                        <a href="{{url('storage/fotos/g/economico_4_1.jpg')}}" data-lightbox="economico_4"><img class="img" src="{{url('storage/fotos/g/economico_4_1.jpg')}}" ></a><a href="{{url('storage/fotos/g/economico_4_2.jpg')}}" data-lightbox="economico_4"><img class="img" src="{{url('storage/fotos/g/economico_4_2.jpg')}}" ></a><a href="{{url('storage/fotos/g/economico_4_3.jpg')}}" data-lightbox="economico_4"><img class="img" src="{{url('storage/fotos/g/economico_4_3.jpg')}}" ></a><a href="{{url('storage/fotos/g/economico_4_4.jpg')}}" data-lightbox="economico_4"><img class="img" src="{{url('storage/fotos/g/economico_4_4.jpg')}}" ></a><a href="{{url('storage/fotos/g/economico_4_5.jpg')}}" data-lightbox="economico_4"><img class="img" src="{{url('storage/fotos/g/economico_4_5.jpg')}}" ></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio">
                    <label>
                        <input id="projeto_economico_2" name="projeto_economico" type="radio" value="5">
                        <h4>Educação Sustentável: Cisterna</h4>
                        <h5>Odete Kruger (SME)</h5>
                        <p class="text-justify">Utiliza a captação da água da chuva através de calhas e tubulações é depositada em uma caixa de água de onde é distribuída para irrigação da horta/jardim e limpeza das calçadas, com essa ação a redução do consumo de água potável. A água da chuva é um recurso natural e gratuito, portanto o objetivo é conscientizar as crianças que a sustentabilidade vai além de questões ambientais, são práticas que auxiliam na preservação dos recursos e até na diminuição dos custos.</p>
                    </label>
                    <div>
                        <a href="{{url('storage/fotos/g/economico_5_1.jpg')}}" data-lightbox="economico_5"><img class="img" src="{{url('storage/fotos/g/economico_5_1.jpg')}}" ></a><a href="{{url('storage/fotos/g/economico_5_2.jpg')}}" data-lightbox="economico_5"><img class="img" src="{{url('storage/fotos/g/economico_5_2.jpg')}}" ></a><a href="{{url('storage/fotos/g/economico_5_3.jpg')}}" data-lightbox="economico_5"><img class="img" src="{{url('storage/fotos/g/economico_5_3.jpg')}}" ></a><a href="{{url('storage/fotos/g/economico_5_4.jpg')}}" data-lightbox="economico_5"><img class="img" src="{{url('storage/fotos/g/economico_5_4.jpg')}}" ></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio">
                    <label>
                        <br>
                        <input id="projeto_economico_3" name="projeto_economico" type="radio" value="">
                        <h4>NENHUMA DAS OPÇÕES ACIMA</h4>
                    </label>
                </div><!-- .radio -->
            </div><!-- .cols-xs-12 -->
        </div><!-- .row -->

        <div class="row">
            <div class="bg-primary col-xs-12">
                <h3 class="text-center">Trabalho Social</h3>
            </div><!-- .bg-primary .col-xs-12 -->
        </div><!-- .row -->
        <div class="row">
            <div class="col-xs-12 projetoConteudo">
                <div class="radio">
                    <label>
                        <!--<input id="projeto_social_1" name="projeto_social" type="radio" value="6">-->
                        <h4>Basquete na Praça!</h4>
                        <h5>Rodrigo Silva (SMCTE)</h5>
                        <p class="text-justify">Esse projeto é realizado na Praça da Juventude todos os sábados as 14 h com crianças carentes da cidade de 07 à 17 anos. Ele é totalmente gratuito. Conto com a parceria da Associação Beneficente Eis Me Aqui, que contribui com lanches. Nossa meta é formar uma equipe para representar a cidade em campeonatos, e formar melhores cidadãos para o futuro. Se alguém quer ajudar ou Inscrever seu filho pode ir até o local aos sábados ou entrar em contato. Rodrigo 981005312</p>
                    </label>
                    <div>
                        <a href="{{url('storage/fotos/g/social_6_1.jpg')}}" data-lightbox="social_6"><img class="img" src="{{url('storage/fotos/g/social_6_1.jpg')}}" ></a><a href="{{url('storage/fotos/g/social_6_2.jpg')}}" data-lightbox="social_6"><img class="img" src="{{url('storage/fotos/g/social_6_2.jpg')}}" ></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio text-center">
                    <label>
                        <br>
                        <h4>Conforme critérios de avaliação, apenas este projeto foi classificado pela Banca Avaliadora.</h4>
                    </label>
                </div><!-- .radio -->
            </div><!-- .cols-xs-12 -->
        </div><!-- .row -->

        <div class="row">
            <div class="bg-primary col-xs-12">
                <h3 class="text-center">Trabalho em Equipe</h3>
            </div><!-- .bg-primary .col-xs-12 -->
        </div><!-- .row -->
        <div class="row">
            <div class="col-xs-12 projetoConteudo">
                <div class="radio">
                    <label>
                        <input id="projeto_equipe_1" name="projeto_equipe" type="radio" value="9">
                        <h4>Gestão de vagas em creche - Ampliar atendimento de vagas na educação infantil</h4>
                        <h5>EDINA BEATRIZ DE OLIVEIRA ILHA, MARIA LORENA MATIAS DOS SANTOS EVER, ELIANE REGINA PACHECO PEREIRA e SUELI LUIZA PERES. (SME)</h5>
                        <p class="text-justify">O trabalho consiste na gestão das vagas para creche.  Desde 2018 estamos realizando um projeto que visa atender 100% da demanda de vagas em creche, atendendo a população numa necessidade fundamental que é o acesso à educação e atendimento para todas as crianças. Em 2018 encaminhamos 846 crianças para as escolas infantis, contemplando 100% da demanda manifesta naquele ano. Em 2019 já atendemos toda a demanda manifesta em fevereiro e 56% dos pedidos de vaga que aconteceram nas inscrições de agosto. </p>
                    </label>
                    <div>
                    <a href="{{url('storage/fotos/g/equipe_9_1.jpg')}}" data-lightbox="equipe_9"><img class="img" src="{{url('storage/fotos/g/equipe_9_1.jpg')}}" width="25%"></a><a href="{{url('storage/fotos/g/equipe_9_2.jpg')}}" data-lightbox="equipe_9"><img class="img" src="{{url('storage/fotos/g/equipe_9_2.jpg')}}" width="25%"></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio">
                    <label>
                        <input id="projeto_equipe_2" name="projeto_equipe" type="radio" value="10">
                        <h4>Ação Humanitária ao Fluxo Migratório de Venezuelanos</h4>
                        <h5>LEONICE MARQUES DOMINGUES, CRISTIANE PACHECO LIMA, MARCIA HANNACKER DE OLIVEIRA DESIDERIO, JEANINE COSTA GODOI, ISRAEL ANTONIO DA SILVA e JUAREZ DA ROSA FLORES. (SMCTE)</h5>
                        <p class="text-justify">A Ação Humanitária ao Fluxo Migratório de Venezuelanos teve como objetivo desenvolver ações para acolhimento temporário dos imigrantes venezuelanos, garantindo condições dignas de vida, inserção social e respeito aos direitos humanos. Empatia e solidariedade são palavras que definem a atitude de Esteio que articulou secretarias, organização da sociedade civil e voluntários para enfrentar o desafio de acolher 221 venezuelanos, que lutavam por sua sobrevivência e de suas famílias.</p>
                    </label>
                    <div>
                    <a href="{{url('storage/fotos/g/equipe_10_1.jpg')}}" data-lightbox="equipe_10"><img class="img" src="{{url('storage/fotos/g/equipe_10_1.jpg')}}" width="30%"></a><a href="{{url('storage/fotos/g/equipe_10_2.jpg')}}" data-lightbox="equipe_10"><img class="img" src="{{url('storage/fotos/g/equipe_10_2.jpg')}}" width="30%"></a><a href="{{url('storage/fotos/g/equipe_10_3.jpg')}}" data-lightbox="equipe_10"><img class="img" src="{{url('storage/fotos/g/equipe_10_3.jpg')}}" width="30%"></a><a href="{{url('storage/fotos/g/equipe_10_4.jpg')}}" data-lightbox="equipe_10"><img class="img" src="{{url('storage/fotos/g/equipe_10_4.jpg')}}" width="30%"></a><a href="{{url('storage/fotos/g/equipe_10_5.jpg')}}" data-lightbox="equipe_10"><img class="img" src="{{url('storage/fotos/g/equipe_10_5.jpg')}}" width="30%"></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio">
                    <label>
                        <input id="projeto_equipe_3" name="projeto_equipe" type="radio" value="11">
                        <h4>Quem sabe faz a hora, não espera acontecer.</h4>
                        <h5> CLAUDIA CORREA DA COSTA e LANNA BENDER CARDOSO (SMF).</h5>
                        <p class="text-justify">É importante a valorização dos Educadores, afinal o conhecimento empodera! Atividades com embasamento fazem a diferença! A inscrição do Programa de Educação Fiscal é para valorizar aquele que faz o diferente com envolvimento e vontade de mudar. O Grupo de Educação Fiscal proporciona encontros de formação, material de estudo e os Educadores disseminam conceitos às crianças para que contribuam com o agora. Futuro melhor para todos é aquele em que mudanças são feitas no dia a dia!</p>
                    </label>
                    <div>
                        <a href="{{url('storage/fotos/g/equipe_11_1.jpg')}}" data-lightbox="equipe_11"><img class="img" src="{{url('storage/fotos/g/equipe_11_1.jpg')}}" ></a><a href="{{url('storage/fotos/g/equipe_11_2.jpg')}}" data-lightbox="equipe_11"><img class="img" src="{{url('storage/fotos/g/equipe_11_2.jpg')}}" ></a><a href="{{url('storage/fotos/g/equipe_11_3.jpg')}}" data-lightbox="equipe_11"><img class="img" src="{{url('storage/fotos/g/equipe_11_3.jpg')}}" ></a><a href="{{url('storage/fotos/g/equipe_11_4.jpg')}}" data-lightbox="equipe_11"><img class="img" src="{{url('storage/fotos/g/equipe_11_4.jpg')}}" ></a><a href="{{url('storage/fotos/g/equipe_11_5.jpg')}}" data-lightbox="equipe_11"><img class="img" src="{{url('storage/fotos/g/equipe_11_5.jpg')}}" ></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio">
                    <label>
                        <br>
                        <input id="projeto_equipe_4" name="projeto_equipe" type="radio" value="">
                        <h4>NENHUMA DAS OPÇÕES ACIMA</h4>
                    </label>
                </div><!-- .radio -->
            </div><!-- .cols-xs-12 -->
        </div><!-- .row -->

        <div class="row">
            <div class="bg-primary col-xs-12">
                <h3 class="text-center">Estagiário Destaque</h3>
            </div><!-- .bg-primary .col-xs-12 -->
        </div><!-- .row -->
        <div class="row">
            <div class="col-xs-12 projetoConteudo">
                <div class="radio">
                    <label>
                       <!-- <input id="projeto_estagiario_1" name="projeto_estagiario" type="radio" value="12">-->
                        <h4>Pesquisa de satisfação como ferramenta de motivação nas relações interpessoais</h4>
                        <h5>Vitoria Maxine (SMAD)</h5>
                        <p class="text-justify">Foi observado no dia a dia de trabalho das secretarias que quanto maior o nível de satisfação dos responsáveis pelo atendimento, os mesmos agem com mais eficiência e contribuem positivamente nos resultados da organização. Pensando nisso, foi implantada no Setor de Atendimento ao Cidadão uma pesquisa de satisfação com o objetivo de aprimorar o ambiente de trabalho, tornando-o um local mais dinâmico, a fim de estimular os funcionários e proporcionar um atendimento de maior qualidade à população. </p>
                    </label>
                    <div>
                        <a href="{{url('storage/fotos/g/estagiario_12_1.jpg')}}" data-lightbox="estagiario_12"><img class="img" src="{{url('storage/fotos/g/estagiario_12_1.jpg')}}" ></a><a href="{{url('storage/fotos/g/estagiario_12_2.jpg')}}" data-lightbox="estagiario_12"><img class="img" src="{{url('storage/fotos/g/estagiario_12_2.jpg')}}" ></a><a href="{{url('storage/fotos/g/estagiario_12_3.jpg')}}" data-lightbox="estagiario_12"><img class="img" src="{{url('storage/fotos/g/estagiario_12_3.jpg')}}" ></a><a href="{{url('storage/fotos/g/estagiario_12_4.jpg')}}" data-lightbox="estagiario_12"><img class="img" src="{{url('storage/fotos/g/estagiario_12_4.jpg')}}" ></a>
                    </div>
                </div><!-- .radio -->
                <div class="radio"  align="center">
                    <label>
                        <br>
                        <!--<input id="projeto_estagiario_4" name="projeto_estagiario" type="radio" value="">-->
                        <h4>Único projeto inscrito nesta categoria</h4>
                    </label>
                </div><!-- .radio -->
            </div><!-- .cols-xs-12 -->
        </div><!-- .row -->
        <div class="row">
            <div class="col-xs-12 text-center" style="margin-bottom: 30px;">
                <a class="btn btn-lg btn-success" onclick="votacao.votar();">VOTAR
                    <button class="btn btn-success" type="submit"></button>
                </a>
            </div><!-- .col-xs-12 .text-center -->
        </div><!-- .row -->
    </fieldset>
</form>
