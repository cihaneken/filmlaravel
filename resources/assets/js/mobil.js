require('./bootstrap');

window.Vue = require('vue');

var _token = $("meta[name='csrf-token']").attr('content');
var app_url = $("meta[name='app-url']").attr('content');
function url(path) {
    return app_url + path;
}
const player = new Vue({
    el: '#player',
    data: {
        videolar: [],
        selected: {},
        part: 1,
        videoyok: false,
        id: 0
    },
    created: () => {
        var id = $("#movie_id").val();
        setTimeout(() => {
            $.ajax({
                url: url("/get-videos/" + id),
                type: 'GET',
                success: (res) => {
                    player.videolar = res;
                    if (player.videolar.length == 0)
                        player.videoyok = true;
                    else {
                        player.id = 0;
                        player.selected = res[0];
                    }
                }
            });
        }, 1500);
    },
    watch: {
        id: (val) => {
            player.selected = player.videolar[player.id];
        }
    },
    methods: {
        menusu: (name) => {
            $('.' + name).toggle();
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