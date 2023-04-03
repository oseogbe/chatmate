{{-- @extends('layouts.app')

@section('extra-css')
<style>
::-webkit-scrollbar {
    width: 5px;
}

::-webkit-scrollbar-track {
    background-color: #000;
}

::-webkit-scrollbar-thumb {
    background-color: var(--primary-color);
    border-radius: 2px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}

.chat-card {
    background: url(/img/bg-chat-pattern.jpg);
}

.chat-body {
    height: 83vh;
    overflow: hidden;
    overflow-y: scroll;
    scroll-behavior: smooth;
    padding-bottom: 0;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="card chat-card">
        <div class="card-body chat-body" id="chatBody">
            <chat-messages
                :messages="messages"
                :user="{{ Auth::user() }}"
            ></chat-messages>
        </div>
        <div class="card-footer">
            <chat-form
                v-on:messagesent="addMessage"
                :user="{{ Auth::user() }}"
                :typing="typing"
                v-on:is-typing="isTyping"
                :user_typing="user_typing"
            ></chat-form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    window.addEventListener('load', function() {
        const chatBody = document.getElementById('chatBody');
        chatBody.scrollTop = chatBody.scrollHeight;
    });
</script>
@endsection --}}
