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
function alert_s(body) {
    $("#customAlert .modal-body").html(body);
    $("#customAlert").modal("show");
} 
function alert_h(body) {
    $("#customAlert .modal-body").html(body);
    $("#customAlert").modal("hide");
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
        }, 30 * 60 * 1000);
    }
});

const liste_olustur = new Vue({
    el: '.liste_olustur',
    data: {
        filmler: [],
        secili: 0,
        name: ""
    },
    methods: {
        ortalama: () => {
            var toplam = 0;
            $.each(liste_olustur.filmler, (i, film) => {
                toplam += film.puan;
            });

            return (toplam / liste_olustur.filmler.length).toFixed(1);
        },
        paylas: () => {
            if (liste_olustur.filmler.length < 4)
                return alert("Listede en az 4 film olmalı.");
            
            if (liste_olustur.name.length < 10)
                return alert("Liste adı en az 10 karakterden oluşmalı.");

            $.ajax({
                url: url("/liste/olustur"),
                type: 'POST',
                data: { _token, filmler: liste_olustur.filmler, name: liste_olustur.name },
                success: (res) => {
                    if (res.status == "error"){
                        alert(res.mesaj);
                    }else{
                        alert(res.mesaj);
                        setTimeout(() => {
                           window.location.href = res.url;
                        }, 2500);
                    }
                }
            }); 
        },
        filmEkle: () => {
            var id = liste_olustur.secili;
            
            if (id == 0)
                return alert("Lütfen bir film seçiniz");

            var varmi = false;
            $.each(liste_olustur.filmler, (i, film) => {
                if (film.id == id)
                    varmi = true;
            });

            if (varmi)
                return alert("Film zaten ekli.");
            alert("Lütfen bekleyiniz, film detayları alınıyor..");
            $.ajax({
                url: url("/filmi-getir"),
                type: 'POST',
                data: { _token, id },
                success: (res) => {
                    alert("..");
                    liste_olustur.filmler.push(res);
                }
            }); 
        }
    }
});


/* ADMİN */

const film_ekle = new Vue({
    el: '#film-ekle',
    data: {
        id: null
    },
    methods: {
        ekle: (id) => {
            if (id == 0 || id == null)
                return alert("Lütfen bir film id si giriniz.");
            
            alert_s("Lütfen bekleyiniz. Film ekleniyor..");
            $.ajax({
                url: url("/admin/add-movie-from-tmdb/" + id),
                type: 'GET',
                success: (res) => {
                    if (res.status == "error")
                        alert_s( res.mesaj );
                    else {
                        alert_s( res.mesaj );
                    }
                }
            }); 
        }
    }
});

const admin = new Vue({
    el: '#admin',
    methods: {
        adminToggle: (id) => {
            $.ajax({
                url: url("/admin/admin-toggle/" + id),
                type: 'GET',
                success: (res) => {
                    alert(res.mesaj);
                }
            });
        },
        adminSil: (id) => {
            $.ajax({
                url: url("/admin/admin-sil/" + id),
                type: 'GET',
                success: (res) => {
                    alert(res.mesaj);
                }
            });
        }
    }
});

const video_ekle = new Vue({
    el: '#video_ekle',
    data: {
        id: 0,
        dil: 0,
        kaynak: null,
        part1: null,
        part2: null,
        part3: null,
        part4: null,
        part5: null,
        part6: null,
    },
    methods: {
        ekle: () => {
            var id = video_ekle.id;
            var dil = video_ekle.dil;
            var kaynak = video_ekle.kaynak;
            var part1 = video_ekle.part1;
            var part2 = video_ekle.part2;
            var part3 = video_ekle.part3;
            var part4 = video_ekle.part4;
            var part5 = video_ekle.part5;
            var part6 = video_ekle.part6;
            $.ajax({
                url: url("/admin/video-ekle"),
                type: 'POST',
                data: { _token, id, dil, part1, kaynak, part2, part3, part4, part5, part6},
                success: (res) => {
                    alert(res.mesaj);
                }
            });
        }
    }
});

const player = new Vue({
    el: '#player',
    data: {
        videolar: [],
        selected: {},
        part: 1
    },
    created: () => {
        var id = $("#movie_id").val();;
        setTimeout(() => {
            $.ajax({
                url: url("/get-videos/" + id),
                type: 'GET',
                success: (res) => {
                    player.videolar = res;
                    player.selected = res[0];
                }
            });
        }, 1500);
    },
    methods: {
        menusu: (name) => {
            $('.'+name).toggle();
        },
        getSrc: () => {
            if (player.part == 1)
                return player.selected.part1;
            if (player.part == 2)
                return player.selected.part2;
            if (player.part == 3)
                return player.selected.part3;
            if (player.part == 4)
                return player.selected.part4;
            if (player.part == 5)
                return player.selected.part5;
            if (player.part == 6)
                return player.selected.part6;
        }
    }
});