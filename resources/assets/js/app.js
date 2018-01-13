require('./bootstrap');

window.Vue = require('vue');

var _token = $("meta[name='csrf-token']").attr('content');
var app_url = $("meta[name='app-url']").attr('content');

function url(path) 
{
    return app_url + path;
}

function alert(body) {
    $("#customAlert .modal-body").html(body);
    $("#customAlert").modal("toggle");
}

const yorum_yap = new Vue({
    el: '.yorum_yap',
    created: () => {
        console.log();
    },
    methods: {
        yorumYap: (movie_id) => {
            mesaj = $("#yorum_mesaj").val();
            $.ajax({
                url: url("/yorum-yap"),
                type: 'POST',
                data: {_token, mesaj, movie_id},
                success: (res) => {
                    alert(res.mesaj);
                    if (res.status == "success")
                    $("#yorum_mesaj").val(' ');
                }
            });
        }
    }
});

/* 30dk sonra izlendi olarak işaretler filmi. */
const izlendi = new Vue({
    el: '.izlendi-vue',
    created: () => {
        var id = $("#izlendi_id").val();
        setTimeout(() => {
            $.ajax({
                url: url("/izlendi"),
                type: 'POST',
                data: { _token, id},
                success: (res) => {
                    console.log(res);
                }
            });
        }, 30 * 1000);
    }
});
