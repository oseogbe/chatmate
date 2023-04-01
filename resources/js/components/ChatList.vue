<template>
    <div>
        <chat-item class="chat-on-focus"></chat-item>
        <chat-item></chat-item>
    </div>
</template>

<script setup>
import ChatItem from '@/components/ChatItem.vue'
</script>

<style lang="scss" scoped>
.chat-on-focus {
    background: var(--primary-color-light);
}
</style>
