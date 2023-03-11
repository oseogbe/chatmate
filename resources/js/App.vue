<script>
import { ref } from 'vue'

export default {
    setup() {
        const messages = ref([]);

        const fetchMessages = async () => {
            try {
                const response = await axios.get('/messages');
                messages.value = response.data;
            } catch (error) {
                // console.error(error);
            }
        };

        const addMessage = async (message) => {
            messages.value.push(message);
            try {
                const response = await axios.post('/messages', message);
                // console.log(response.data);
            } catch (error) {
                // console.error(error);
            }
        };

        fetchMessages();

        Echo.private('chatme').listen('.message-sent', (e) => {
            messages.value.push({
                message: e.message.message,
                user: e.user,
            });
        });

        return {
            messages,
            addMessage,
        };
    },
}
</script>
