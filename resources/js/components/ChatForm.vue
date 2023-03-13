<template>
    <div>
        <div class="input-group">
            <input
                id="btn-input"
                type="text"
                name="message"
                class="form-control input-sm"
                placeholder="Type your message here..."
                v-model="newMessage"
                @keydown="onUserTyping"
                @keyup.enter="sendMessage"
                autocomplete="off"
            />
            <span class="input-group-btn" style="margin-left: 12px;">
                <button class="btn btn-primary btn-sm h-100" id="btn-chat" @click="sendMessage" :disabled="!newMessage">
                Send
                </button>
            </span>
        </div>
        <span v-show="props.typing" class="help-block" style="font-style: italic;">
            @{{ props.user_typing }} is typing...
        </span>
    </div>
</template>
<script setup>
import { ref } from 'vue'

const props = defineProps(['user', 'typing', 'user_typing'])

const emit = defineEmits(['messagesent', 'isTyping'])

const onUserTyping = () => {
    emit('isTyping', {
        username: props.user.name
    })
}

const newMessage = ref('')

const sendMessage = () => {
    emit('messagesent', {
        user: props.user,
        message: newMessage.value,
    })

    newMessage.value = ''
}

</script>
