/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function () {
    $("#btnPesquisar").click(function (e) {
        carregarTabela(1);
        e.preventDefault();
    });
/*
        Usando Javascript  
        var actionButton = document.querySelector('.action');
        actionButton.addEventListener('click', myFunction);
        
         Usando jQuery 
        $('.action').on('click', myFunction);
        
        $("a.paginar").click(function (e) {
            carregarTabela($(this).data("pagina"));
            e.preventDefault();        
        });
*/
});

function carregarTabela(pagina) {
    //limpo o conteudo anterior da tabela
    let clone = $("#linhaModelo").clone();
    $("#tableUsers").text('');
    clone.appendTo("#tableUsers");

    //limpo o conteudo anterior da paginação
    clone = $("#listaPaginasSpan").clone();
    $("#listaPaginas").text('');
    clone.appendTo("#listaPaginas");

    let url = urlPage(pagina);

    $.getJSON(url, function (result) {
        $.each(result.data, function (indice, user) {
            clone = $("#linhaModelo").clone().removeClass("ocultar");
            clone.id = "";
            clone.find("[name='id']").text(user.idpp);
            clone.find("[name='name']").text(user.nome);
            clone.find("[name='username']").text(user.username);

            clone.appendTo("#tableUsers");
        });

        let paginas = (result.paging.totalpages < 10) ? result.paging.totalpages : 10;

        let inicio = result.paging.thispage - paginas + 1;
        if (inicio < 0) inicio = 1;

        let final = inicio + paginas - 1;
        if (final > result.paging.totalpages) final = result.paging.totalpages;


        //forma os botoes de pagina e atribui
        const ASPAS = '"';
        let textoHtml = "";
        if (inicio > 1) {
            textoHtml = liBotaoPagina(false, inicio - 1, "Anterior");
            $(textoHtml).appendTo("#listaPaginas");
        }

        textoHtml = "";
        for (let index = inicio; index <= final; index++) {
            textoHtml = liBotaoPagina(result.paging.thispage == index, index, index);
            $(textoHtml).appendTo("#listaPaginas");
        }

        textoHtml = "";
        if (result.paging.totalpages > final) {
            textoHtml = liBotaoPagina(false, result.paging.thispage + 1, "Próxima");
            $(textoHtml).appendTo("#listaPaginas");
        }

        $("a.paginar").click(function (e) {
            carregarTabela($(this).data("pagina"));
            e.preventDefault();        
        });
    });
}

/**
 * Retorna a url com page = ao numero passado
 * 
 * @param {*} numeroPagina numero da pagina
 */
function urlPage(numeroPagina) {
    if (typeof numeroPagina === "undefined") {
        numeroPagina = 1;
    }
    let ret = document.location.origin + "/api/busca/?search=";
    ret +=  document.getElementById("campoPesquisa").value;
    ret +=  "&page=" + numeroPagina;

    return ret;
}

/**
 * Retorna os Botoes da paginação
 * 
 * @param {*} ativo   Se o Link vai ter a classe active
 * @param {*} pagina  Pagina que o botão esta associado
 * @param {*} texto   Texto que aperecera no botao
 */
function liBotaoPagina(ativo, pagina, texto) {
    const ASPAS = '"';
    let ret = "<li";
    if (ativo) {
        ret +=  ' class="active" ';
    }
    ret += '><a href="#void" class="paginar" data-pagina="' + pagina + ASPAS;
    ret += ' >' + texto + '</a></li>';

    return ret;
}

/*
            
            $(textoHtml).click(function (e) {
                carregarTabela($(this).data("pagina"));
                e.preventDefault();        
            });
        


<button type="button" data-aluno="<?php echo $aluno; ?>" class="botaoAluno">Clique aqui</button>
$(document).ready(function(){
    $(document).on('click', '.botaoAluno', function(){
        func();
        var aluno = $(this).data('aluno');
        var resposta = confirm("Deseja remover esse aluno?");

         if (resposta == true) {
              window.location.href = "del_aluno_done.php?aluno=" + aluno;
         }
         // ou pode manter a funcao à parte e chamar `confirmacao(aluno);` aqui dentro
    });
});

<a href="#void" onclick="myFunction();">Executar JavaScript</a>

function liBotaoPagina(ativo, pagina, texto){
    const ASPAS = '"';
    let ret  = "<li";
    if ( ativo ) {
        ret +=  " class=" + ASPAS + "active" + ASPAS;
    }
    ret +=  "><a href=";
    ret +=  ASPAS +  urlPage( pagina ) +  ASPAS;
    ret += " >" + texto + "</a></li>";

    return ret;
}
*/



/*
        result.data.forEach(function (element) {
            clone = $("#linhaModelo").clone().removeClass("ocultar");
            clone.id = "";
            clone.find("[name='id']").text(element.id);
            clone.find("[name='name']").text(element.name);
            clone.find("[name='username']").text(element.username);

            clone.appendTo("#tableUsers");

        }, this);

        let paginas = (result.paging.totalpages < 10) ? result.paging.totalpages : 10;

        let inicio = result.paging.thispage - paginas + 1;
        if (inicio < 0) inicio = 1;

        let final = inicio + paginas - 1;
        if (final > result.paging.totalpages) final = result.paging.totalpages;


        //forma os botoes de pagina e atribui
        const ASPAS = '"';
        let textoHtml = "";
        if (inicio > 1) {
            textoHtml = "<li><a href=" + ASPAS + "pagina=";
            textoHtml = textoHtml + (inicio - 1);
            textoHtml = textoHtml + ASPAS + ">"
            textoHtml = textoHtml + "Anterior"
            textoHtml = textoHtml + "</a></li>"

            $(textoHtml).appendTo("#listaPaginas");
        }

        textoHtml = "";
        for (var index = inicio; index <= final; index++) {
            textoHtml = "<li";
            if (result.paging.thispage == index) {
                textoHtml = textoHtml + " class=" + ASPAS + "active" + ASPAS;
            }
            textoHtml = textoHtml + "><a href=" + ASPAS + "pagina=";
            textoHtml = textoHtml + index + ASPAS;
            textoHtml = textoHtml + ">";
            textoHtml = textoHtml + index;
            textoHtml = textoHtml + "</a></li>";

            $(textoHtml).appendTo("#listaPaginas");
        }

        textoHtml = "";
        if (result.paging.totalpages > final) {
            textoHtml = "<li><a href=" + ASPAS + "pagina=";
            textoHtml = textoHtml + (final + 1);
            textoHtml = textoHtml + ASPAS + ">"
            textoHtml = textoHtml + "Próxima"
            textoHtml = textoHtml + "</a></li>"

            $(textoHtml).appendTo("#listaPaginas");
        }
*/