var websocket = io.connect("http://localhost:8080");

window.onload = function() {

    websocket.on('connect', function(data) {
        
        });

    websocket.on("sendEvent", function(data){
       var river_list = $('.elgg-list.elgg-list-river');
       if (river_list.length > 0) {
           river_list.prepend(data.msg);
       }
    });
};