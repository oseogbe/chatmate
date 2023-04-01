<template>
    <div class="d-flex p-4" role="button">
        <div class="chat-user-img">
            <img src="/img/profile-pic/user-1.png" alt="">
        </div>
        <div class="ps-3">
            <h5>Andy Konstatinos</h5>
            <small>Could you help with the groceries...</small>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>
    .chat-user-img {
        flex-basis: 15%;

        img {
            width: 100%;
            border-radius: 50%;
            background: var(--primary-color);
            padding: 1.5px;
        }
    }
</style>
