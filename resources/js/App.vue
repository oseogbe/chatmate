<script>
import { ref, watch } from 'vue'
import { useChatStore } from './stores/chat'

export default {
    setup() {
        const store = useChatStore()

        let chatId = ref(null)

        watch(() => store.chatId, (newChatId) => chatId.value = newChatId)

        if(chatId.value) {
            // set up Echo channel with new chatId
            let channel = Echo.private(`chatmate.chats.${chatId.value}`)

            channel.listen('.new.chat', (e) => {
                store.addMessage(e.message)
            })
        }
    }
}
</script>
