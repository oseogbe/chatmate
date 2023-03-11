<template>
    <div class="input-group">
        <input
            id="btn-input"
            type="text"
            name="message"
            class="form-control input-sm"
            placeholder="Type your message here..."
            v-model="newMessage"
            @keyup.enter="sendMessage"
        />
        <span class="input-group-btn" style="margin-left: 12px;">
            <button class="btn btn-primary btn-sm h-100" id="btn-chat" @click="sendMessage">
            Send
            </button>
        </span>
    </div>
</template>
<script setup>
import { ref } from 'vue'

const props = defineProps(['user'])

const emit = defineEmits(['messagesent'])

const newMessage = ref('')

const sendMessage = () => {
    emit('messagesent', {
        user: props.user,
        message: newMessage.value,
    });

    newMessage.value = '';
}
</script>
