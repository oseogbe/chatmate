<template>
    <ul>
        <li v-for="message in messages" :key="message.id">
            <p class="chat">
                <span class="chat-user">
                    <small>{{ message.user.name }}</small>
                </span>
                <div class="chat-message">
                    <strong>{{ message.message }}</strong>
                </div>
            </p>
        </li>
    </ul>
</template>
<script setup>
defineProps(['messages'])
</script>
<style lang="scss" scoped>

ul {
    list-style: none;
    padding-left: 0;

    .chat {
        display: flex;
        justify-content: space-between;
        align-items: center;

        .chat-user {
            flex-basis: 25%;
            padding: 4px 8px;
            background: #b44b81;
            color: #fff;
            border-radius: 8px;

            @media(min-width: 500px) {
                flex-basis: 15%;
            }

            @media(min-width: 992px) {
                flex-basis: 10%;
            }
        }

        .chat-message {
            flex-basis: 75%;
            padding-left: 8px;

            @media(min-width: 500px) {
                flex-basis: 85%;
            }

            @media(min-width: 992px) {
                flex-basis: 90%;
            }
        }
    }
}
</style>
