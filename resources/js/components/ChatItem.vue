<template>
    <div class="d-flex p-4" role="button">
        <div class="chat-user-img">
            <img :src="chat.contact.profile_pic ?? '/img/profile-placeholder.jpg'" alt="">
        </div>
        <div class="ps-3">
            <h5>{{ chat.contact.username }}</h5>
            <small>Could you help with the groceries...</small>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(['chat'])
const chat = props.chat
</script>

<style lang="scss" scoped>
    .chat-user-img {
        flex-basis: 15%;

        img {
            width: 100%;
            border-radius: 50%;
            // background: var(--primary-color);
            padding: 1.5px;
        }
    }
</style>
