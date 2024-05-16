<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import Rooms from './Rooms.vue';
import Messages from './Messages.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue'


const props = defineProps(['chatRooms', 'messages', 'selectedRoomId'])
const page = usePage(['user'])

onMounted(() => {
    if (props.selectedRoomId) {
        Echo.join(`chat.${props.selectedRoomId}`)
            .here((users) => {
                console.log("All users here : " + users.map((user) => user.name));
            })
            
            .joining((user) => {
                console.log(user.name + " joined");
            })
            .leaving((user) => {
                console.log(user.name + " left");
            })

            .error((error) => {
                console.error(error);
            });

        const id = ref(page.props.auth.user.id)
   
       
           
    }



})
onUnmounted(() => {
    Echo.leave(`chat.${props.selectedRoomId}`)
})



const selectRoom = (chatroom) => {
    const form = useForm({
        selected_room: chatroom.id,
    })
    router.get(route('chat.getMessages', form.selected_room))
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
                        <Rooms :selectedRoomId="selectedRoomId" :chatRooms="chatRooms" @selectRoom="selectRoom" />
                    </div>

                    <div class="ml-4 shadow-lg sm:rounded-lg  bg-white dark:bg-gray-800">
                        <Messages :messages="messages" :selectedRoomId="selectedRoomId" />
                    </div>

                </div>


            </div>
        </div>

    </AuthenticatedLayout>
</template>
