var server = require("socket.io").listen(8080);

server.sockets.on("connection", function(socket)
{

    socket.on("newMessage", function(data){
        console.log(data);

        server.sockets.emit("sendEvent", data);
    });


    socket.on('addUser', function(data) {
        
        });

    socket.on('disconnect', function(data){
        console.log('Server has disconnected');
    });

});
