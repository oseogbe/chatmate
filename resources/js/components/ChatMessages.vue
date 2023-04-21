<template>
    <ul>
        <li v-for="(message, index) in messageList" :key="index">
            <p class="chat" :class="{'chat-left': user.id !== message.user_id}">
                <div class="chat-message">
                    <strong>{{ message.message }}</strong>
                </div>
                <span class="chat-user">
                    <small>{{ message.username }}</small>
                </span>
            </p>
        </li>
    </ul>
</template>
<script setup>
import { computed } from 'vue'
import { useChatStore } from '../stores/chat'

const store = useChatStore()

const props = defineProps(['user'])

const messageList = computed(() => store.messages)
</script>
<style lang="scss" scoped>

ul {
    list-style: none;
    padding-left: 0;

    .chat {
        display: flex;
        flex-direction: column;

        .chat-user {
            color: #3d3c3c;

            small {
                float: right;
            }

            @media(min-width: 500px) {
                flex-basis: 15%;
            }

            @media(min-width: 992px) {
                flex-basis: 10%;
            }
        }

        .chat-message {
            padding: 4px 8px;
            background: #b44b81;
            color: #fff;
            border-radius: 8px;
            width: max-content;
            align-self: flex-end;

            strong {
                float: right;
                padding-right: 8px;
            }

            @media(min-width: 500px) {
                flex-basis: 85%;
            }

            @media(min-width: 992px) {
                flex-basis: 90%;
            }
        }
    }

    .chat-left {
        .chat-user {

            small {
                float: left;
            }
        }

        .chat-message {
            align-self: flex-start;
        }
    }
}
</style>
