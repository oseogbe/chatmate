<script>
import { ref } from 'vue'

export default {
    setup() {
        const messages = ref([])

        const fetchMessages = async (chatId) => {
            try {
                const response = await axios.get(`chats/${chatId}/messages`)
                messages.value = response.data
            } catch (error) {
                // console.error(error)
            }
        }

        const addMessage = async (message) => {
            messages.value.push(message)
            try {
                const response = await axios.post('/messages', message)
                // console.log(response.data)
            } catch (error) {
                // console.error(error)
            }
        }

        let channel = Echo.private('chatme')

        channel.listen('.message-sent', (e) => {
            messages.value.push({
                message: e.message.message,
                user: e.user,
            })
        })


        const user_typing = ref('')
        const typing = ref(false)

        channel.listenForWhisper('typing', (e) => {
            user_typing.value = e.user_typing.username
            typing.value = e.typing

            // remove is typing indicator after 0.9s
            setTimeout(function() {
                typing.value = false
            }, 1500)
        })

        const isTyping = (username) => {

            setTimeout(function() {
                channel.whisper('typing', {
                    user_typing: username,
                    typing: true
                })
            }, 300)
        }

        return {
            // messages,
            // fetchMessages,
            addMessage,
            isTyping,
            user_typing,
            typing
        }
    },
}
</script>
