import { ref, watch } from 'vue'
import { defineStore } from 'pinia'

export const useChatStore = defineStore('chat', () => {
    const chatId = ref(null)
    const messages = ref([])

    const fetchMessages = async () => {
        try {
            const response = await axios.get(`chats/${chatId.value}/messages`)
            messages.value = response.data
        } catch (error) {
            // console.error(error)
        }
    }

    const addMessage = async (message) => {
        messages.value.push(message)
        try {
            await axios.post(`chats/${chatId.value}/message`, {message})
        } catch (error) {
            // console.error(error)
        }
    }

    watch(chatId, () => fetchMessages())

    return {
        chatId,
        messages,
        addMessage
    }
})
