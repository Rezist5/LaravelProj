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
            <input type="hidden" name="recipient_id" value="{{ $recepient->id }}">
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