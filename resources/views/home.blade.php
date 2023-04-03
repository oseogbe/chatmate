@extends('layouts.app')

@section('extra-css')
<style>
#chat-container {
    z-index: 99999;
}

.card-header {
    background: #fff;
    color: var(--primary-color);
    border: none;
    font-size: 18px;
}

.chat-body {
    height: 72vh;
    overflow: hidden;
    overflow-y: scroll;
    scroll-behavior: smooth;
    /* background: url(/img/bg-chat-pattern.jpg); */
}

::-webkit-scrollbar {
    width: 0;
}
/*
::-webkit-scrollbar-track {
    background-color: #000;
}

::-webkit-scrollbar-thumb {
    background-color: var(--primary-color);
    border-radius: 2px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #555;
} */

.modal-header {
    background: var(--primary-color);
    color: #fff;
}
</style>
@endsection

@section('content')
<div id="chat-container" class="container">
    <chat-options></chat-options>
    <div class="row">
        <div class="offset-md-3 col-md-9 text-end">
            <div class="card text-start rounded-top rounded-top-left rounded-top-right rounded-0">
                <div class="card-header">{{ __('Chat') }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <chat-list></chat-list>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card rounded-0 rounded-bottom">
                <div class="card-body chat-body" id="chatBody">
                    <chat-messages
                        :messages="messages"
                        :user="{{ Auth::user() }}"
                    ></chat-messages>
                </div>
                <div class="card-footer chat-form">
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
@endsection
