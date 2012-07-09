var server = require("socket.io").listen(8080);

server.sockets.on("connection", function(socket) {

    socket.on("newMessage", function(data){
//        console.log(data);
        server.sockets.emit("sendEvent", data);
    });


    socket.on('addUser', function(data) {
        // TODO: Add users, when them connect to a list
    });

    socket.on('disconnect', function(data){
        //TODO: Remove users when disconnect from the list
    });


   socket.on('debug', function(data) {
       console.log(data);
   });
});
