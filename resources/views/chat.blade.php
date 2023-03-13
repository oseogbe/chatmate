@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body chat-body">
            <chat-messages :messages="messages"></chat-messages>
        </div>
        <div class="card-footer">
            <chat-form
                v-on:messagesent="addMessage"
                :user="{{ Auth::user() }}"
                :typing="typing"
                v-on:is-typing="isTyping"
                :user_typing="user_typing"
            >
            </chat-form>
        </div>
    </div>
</div>
@endsection
