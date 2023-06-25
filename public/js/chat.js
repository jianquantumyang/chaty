
function getCookieValue(cookieName) {
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith(cookieName + '=')) {
      return cookie.substring(cookieName.length + 1);
    }
  }
  return null;
}
const messages = document.querySelector(".messages");
const token = getCookieValue("auth");
const username = getCookieValue("username");
// Create a new WebSocket instance
var socket = new WebSocket('ws://127.0.0.1:3002');
const sendBtn = document.getElementById('send_btn');
const inputField = document.querySelector('.message_txt');

sendBtn.addEventListener('click', () => {
  var url = window.location.href;

  var regex = /\/chats\.php\/(\w+)/;

  // Extract the chat ID from the URL
  var match = regex.exec(url);
  var chatId = match[1];
  const message = inputField.value;
  const data = {
    auth: token,
    chat_id: chatId,
    message: message
  };
  // Send the data to the WebSocket server
  socket.send(JSON.stringify(data));

  // Clear the input field
  inputField.value = '';
});
// Event handler for when the WebSocket c


// Event handler for rece147iving messages from the WebSocket server
// Event handler for receiving messages from the WebSocket server
socket.onmessage = function (event) {
  const message = JSON.parse(event.data); // Assuming the message is received as JSON

  // Create a new message element
  const messageElement = document.createElement('div');
  messageElement.classList.add('flex');

  // Check if the message belongs to the current user
  if (message.username === username) {
    messageElement.classList.add('justify-end');
  } else {
    messageElement.classList.add('justify-start');
  }

  // Create the message text element
  const messageText = document.createElement('div');
  messageText.classList.add('mr-2', 'py-3', 'px-4', 'bg-blue-400', 'rounded-bl-3xl', 'rounded-tl-3xl', 'rounded-tr-xl', 'text-white');
  messageText.innerHTML = message.username
  messageText.innerHTML+= '<br>';
  messageText.innerHTML+=  message.message;
  const avatarImage = document.createElement('img');
  avatarImage.src = '/media/' + message.avatar;
  avatarImage.classList.add('object-cover', 'h-8', 'w-8', 'rounded-full');
  avatarImage.alt = '';

  // Append the elements to the message container
  messageElement.appendChild(messageText);
  messageElement.appendChild(avatarImage);

  // Append the message container to the chat interface
  messages.appendChild(messageElement);
};


// Event handler for when the WebSocket connection is closed
