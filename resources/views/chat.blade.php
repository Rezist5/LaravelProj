@extends('layout')
@include('header')
@section('main_content')
<h1>Chat Page</h1>
    @if ($selectedChat)
        <h2>Chat with {{ $recepient->username }}</h2>
        <h2>Messages</h2>
        <ul id="ChatMessages">
            @foreach ($messages as $message)
            @if($message->author_id == $currentUser->id)
                <div class="user-message">{{$message->message}}</div>
            @else
            <div class="other-user-message">{{$message->message}}</div>
            @endif
            @endforeach
        </ul>

        <form id="sendChatMessageForm" method="POST" action="{{ route('send-message') }}">
            @csrf
            <input type="hidden" name="chat_id" value="{{ $selectedChat->id }}">
            <input type="hidden" name="recipient_id" id ="recipient_id" value="{{ $recepient->id }}">
            <label for="chatMessageInput">Your message to {{ $selectedChat->user2->name }}:</label>
            <textarea name="message" id="chatMessageInput" rows="4" cols="50"></textarea>
            <button type="submit">Send Message</button>
        </form>
    @else
        <p>No chat selected.</p>
    @endif

    <form id="changeChatForm" method="POST" onsubmit="return changeChatAction();">
        @csrf
        <label for="teacherSelect">Select teacher:</label>
        <select name="teacher_id" id="teacherSelect">
            @foreach ($teachersChange as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
        <button type="submit">Change Chat</button>
    </form>
    <script>
        const socket = new WebSocket('wss://10.10.10.100:6001'); // Адрес вашего WebSocket сервера

        socket.onopen = function(event) {
            console.log('WebSocket connection established');
        };
        socket.onopen = function(event) {
            const recepientId = document.getElementById('recipient_id'); // Ваш recepientId
            socket.send(JSON.stringify({ type: 'recepient_id', recepientId: recepientId }));
        };
        socket.onmessage = function(event) {
            // Обновляем чат после получения нового сообщения
            updateChatRecive(event.data); // Предполагается, что event.data содержит текст сообщения
        };

        document.getElementById('sendChatMessageForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Отменяем стандартное поведение формы (перезагрузку страницы)

        const messageInput = document.getElementById('chatMessageInput');
        const recipientId = document.getElementById('recipient_id');
        const message = messageInput.value.trim();

        if (message !== '') {
                sendMessage(message, recipientId); // Отправляем сообщение через WebSocket
                messageInput.value = ''; // Очищаем поле ввода сообщения после отправки
            }
        });

        function sendMessage(message, recipientId) {
            // Отправляем сообщение через WebSocket
            const messageData = {
                type: 'chat_message',
                message: message,
                recipient_id: recipientId
            };
            socket.send(JSON.stringify(messageData));
            updateChatSend(message);
        }

        function updateChatRecive(message) {
            // Обновляем интерфейс чата с новым сообщением
            const chatMessages = document.getElementById('ChatMessages');
            const newMessage = document.createElement('div');
            newMessage.className = 'other-user-message'; // Предположим, что это сообщение от другого пользователя
            newMessage.textContent = message; // Вставляем текст сообщения в элемент
            chatMessages.appendChild(newMessage); // Добавляем новое сообщение к списку сообщений
        }
        function updateChatSend(message) {
            // Обновляем интерфейс чата с новым сообщением
            const chatMessages = document.getElementById('ChatMessages');
            const newMessage = document.createElement('div');
            newMessage.className = 'user-message'; // Предположим, что это сообщение от другого пользователя
            newMessage.textContent = message; // Вставляем текст сообщения в элемент
            chatMessages.appendChild(newMessage); // Добавляем новое сообщение к списку сообщений
        }
        function changeChatAction() {
            const teacherId = document.querySelector('#teacherSelect').value;
            const formAction = '{{ route('chat.page', ['teacherId' => ':teacherId']) }}';
            const newAction = formAction.replace(':teacherId', teacherId);
            document.querySelector('#changeChatForm').action = newAction;
            return true;
        }
    </script>

    
    <!-- Форма для начала нового чата -->

    
    <form id="startChatForm" method="POST" action="{{ route('start-chat') }}">
        @csrf
        <label for="newChatRecipient">Select teacher to start a new chat:</label>
        <select name="newChatRecipient" id="newChatRecipient">
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>

        <button type="submit">Start New Chat</button>
    </form>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
@endsection