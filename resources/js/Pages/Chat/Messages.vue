<script setup>


defineProps(['messages'])
</script>

<template>
    <div class="w-[550px]">
        <div class="overflow-auto max-h-[400px]">
            <div class="m-2">
                <div v-for="message in messages" class="flex flex-col   py-1 font-mono  text-white">
                    <div :class="[message.user_id === $page.props.auth.user.id ? 'text-right self-end max-w-96' : 'text-left self-start max-w-96',
                    message.user_id === $page.props.auth.user.id ? 'bg-green-500' : 'bg-teal-500',
                        'p-3 rounded shadow-2xl ']">
                        {{ message.content }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Form -->
        <form v-if="messages" @submit.prevent="$emit('sendMessage')" class="flex relative items-center justify-between px-6 py-4 bg-gray-800/7  bottom-0">

            <input type="text" placeholder="send message"/>
        </form>
    </div>



</template>

<style>
@keyframes growShrink {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.1);
    }

    100% {
        transform: scale(1);
    }
}
</style>