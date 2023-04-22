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
            <span class="input-group-btn" style="margin-left: 12px">
                <button
                    class="btn btn-primary btn-sm h-100"
                    id="btn-chat"
                    @click="sendMessage"
                    :disabled="!newMessage"
                >
                    Send
                </button>
            </span>
        </div>
        <span
            v-show="typing"
            class="help-block"
            style="font-style: italic"
        >
            @{{ userTyping }} is typing...
        </span>
    </div>
</template>
<script setup>
import { ref } from "vue"
import { useChatStore } from "../stores/chat"

const store = useChatStore()

const props = defineProps(["user"])
const username = props.user.username

let channel = Echo.private(`chatmate.chats.${store.chatId}`)

const typing = ref(false)
const userTyping = ref("")

let lastTypingTime = 0
let timeoutId = null

const onUserTyping = () => {
    if (!typing.value) {
        // typing.value = true
        channel.whisper("typing", {
            user_typing: username,
            typing: true,
        })
    }

    clearTimeout(timeoutId)

    timeoutId = setTimeout(() => {
        if (Date.now() - lastTypingTime >= 1000) {
            // typing.value = false
            // userTyping.value = ""
            channel.whisper("typing", {
                user_typing: username,
                typing: false,
            })
        }
    }, 1000)

    lastTypingTime = Date.now()
}

channel.listenForWhisper('typing', (e) => {
    userTyping.value = e.user_typing
    typing.value = e.typing
})

const newMessage = ref("")

const sendMessage = () => {
    store.addMessage(newMessage.value)
    newMessage.value = ""
}
</script>
