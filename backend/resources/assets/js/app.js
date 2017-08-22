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

$(document).ready(function() {
    $("#btnPesquisar").click(function(e) {
        e.preventDefault();
        //limpo o conteudo anterior
        let clone = $("#linhaModelo").clone();
        $("#tableUsers").text('');
        clone.appendTo("#tableUsers");

        result = {
            data: [{
                    id: 'xxx.xxx.001',
                    name: 'Nome 001',
                    username: "nome.001"
                },
                {
                    id: 'xxx.xxx.002',
                    name: 'Nome 002',
                    username: "nome.002"
                },
                {
                    id: 'xxx.xxx.003',
                    name: 'Nome 003',
                    username: "nome.003"
                },
            ],
            paging: {
                thispage: 13,
                sizepage: 15,
                totalpages: 20,
                totalrows: 22,
            },
        };

        result.data.forEach(function(element) {
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

        //limpo o conteudo anterior
        clone = $("#listaPaginasSpan").clone();
        $("#listaPaginas").text('');
        clone.appendTo("#listaPaginas");

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
    });
});