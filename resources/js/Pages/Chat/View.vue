<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Rooms from './Rooms.vue';
import Messages from './Messages.vue';
import { useForm } from '@inertiajs/vue3'

const props = defineProps(['chatRooms','messages'])

const chatRooms = props.chatRooms

const selectRoom = (chatroom) => {

    const form = useForm({
        chatroom: chatroom
    })

    form.post(route('chat.getMessages', chatroom), {
        preserveScroll: true,
        onSuccess: (data) => {
            console.log("success")
        }
    })

}
</script>

<template>

    <Head :title="$page.props.auth.team.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Chat</h2>
        </template>

        <div class="py-12">
            <div class="flex max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Room List -->
                <div class="flex flex-row h-[400px] text-semibold dark:text-gray-100">
                    <div class=" shadow-lg sm:rounded-lg  bg-white dark:bg-gray-800">
                        <Rooms :chatRooms="chatRooms" @selectRoom="selectRoom" />
                    </div>

                    <div class="ml-4 shadow-lg sm:rounded-lg  bg-white dark:bg-gray-800">
                        <Messages :messages="messages"/>
                    </div>

                </div>


            </div>
        </div>

    </AuthenticatedLayout>
</template>
