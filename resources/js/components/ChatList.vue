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
import { useChatStore } from '../stores/chat'
import ChatItem from '@/components/ChatItem.vue'

const store = useChatStore()

const props = defineProps(['chats'])

const chats = props.chats.data
const currentChatId = ref(chats[0].id)
store.chatId = currentChatId.value

const onChatItemClick = chatId => {
    store.chatId = currentChatId.value = chatId
}

const isFocused = (chatId) => currentChatId.value === chatId
</script>

<style lang="scss" scoped>
.chat-on-focus {
    background: var(--primary-color-light);
}
</style>
