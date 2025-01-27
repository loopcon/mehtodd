const fs = require("fs");
const tls = require("tls");
const express = require("express");
// const https = require('https');
const http = require("http");
const socketIo = require("socket.io");
const { log } = require("console");

// Create an express app
const app = express();

// Load the CA certificate
const caCert = fs.readFileSync("cert.pem");

// Load the private key and certificate
const privateKey = fs.readFileSync("selfserversigned.key", "utf8");
const certificate = fs.readFileSync("selfsigned.crt", "utf8");

const credentials = { key: privateKey, cert: certificate, ca: caCert };

// Create an HTTPS server
// const server = https.createServer(credentials, app);
const server = http.createServer(app);

// Initialize socket.io with CORS configuration
const io = socketIo(server, {
  cors: {
    origin: "*"
  }
});

io.on("connection", socket => {
  console.log("a user connected");

  socket.on('joinRoom', (room) => {
    socket.join(room);
    console.log(`User joined room: ${room}`);
  });

  socket.on('leaveRoom', (room) => {
    socket.leave(room);
    console.log(`User left room: ${room}`);
  });


  
  socket.on("sendChatToServer", (data) => {
    // message, receiver_id, sender_id
    const { senderId, receiverId, message } = data;
    
    console.log(senderId, receiverId, message);
    // socket.broadcast.emit("sendChatToClient", data);
    socket.to(receiverId).emit("sendChatToClient", data);

  });
});

server.listen(8443, () => {
  console.log("Server is running on port 8443");
});
