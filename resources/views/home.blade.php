@extends('layouts.app')

@section('extra-css')
<style>
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
<div class="container">

    <div class="row mb-3">
        <div class="d-flex justify-content-end">
            <!-- New Chat -->
            <button
                type="button"
                class="btn btn-outline-primary me-3"
                data-bs-toggle="modal"
                data-bs-target="#newChatModal"
            >
                New Chat <i class="bi bi-chat"></i>
            </button>
            <!-- New Chat Modal -->
            <div class="modal fade" id="newChatModal" tabindex="-1" aria-labelledby="newChatModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newChatModalLabel">New Chat</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="newChatEmailInput" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="newChatEmailInput" placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Invite <i class="bi bi-person-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of New Chat Modal -->
            <!-- End of New Chat -->

            <!-- New Group Chat -->
            <button
                type="button"
                class="btn btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#newGroupChatModal"
            >
                New Group <i class="bi bi-people"></i>
            </button>
            <!-- New Group Chat Modal -->
            <div class="modal fade" id="newGroupChatModal" tabindex="-1" aria-labelledby="newGroupChatModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newGroupChatModalLabel">New Group Chat</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="newGroupChatNameInput" class="form-label">Name</label>
                                <input type="text" class="form-control" id="newGroupChatNameInput">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Create
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                    <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of New Group Chat Modal -->
            <!-- End of New Group Chat -->
        </div>
    </div>
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
