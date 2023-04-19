<template>
    <div>
        <chat-item
            v-for="chat in chats"
            :key="chat.id"
            :chat="chat"
            @click="onChatItemClick(chat.id)"
            :class="{ 'chat-on-focus': isFocused(chat.id) }"
        ></chat-item>
    </div>
</template>

<script setup>
import { ref } from 'vue'

import ChatItem from '@/components/ChatItem.vue'

const props = defineProps(['chats'])
const chats = props.chats.data

const focusedChatId = ref(chats[0].id)

const onChatItemClick = chatId => {
    // emit an event to get the messages and populate chat messages component

    return focusedChatId.value = chatId
}

const isFocused = (chatId) => focusedChatId.value === chatId
</script>

<style lang="scss" scoped>
.chat-on-focus {
    background: var(--primary-color-light);
}
</style>
