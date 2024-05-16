<script setup>
import { useForm } from '@inertiajs/vue3';
import { Send, DotIcon } from 'lucide-vue-next';
import { onMounted, nextTick, watch, onUnmounted, ref } from 'vue';
import { initFlowbite } from 'flowbite'
const props = defineProps(['messages', 'selectedRoomId'])




// const scrollToBottom = () => {
//     scroll.current.scrollIntoView({ behavior: "smooth" });
// };

const form = useForm({
    content: ''
})
const scrolll = ref(null);

const scrollToBottom = () => {
    // console.log("Scrolling to bottom...");
    // console.log("Scroll ref:", scrolll.value);
    if (scrolll.value) {
        scrolll.value.scrollIntoView();
    } else {
        console.log("Scroll ref is null or undefined.");
    }
};
onMounted(() => {
    initFlowbite();

    if (props.selectedRoomId) {

       
       

        nextTick(() => {

            scrollToBottom();
            
        })
        


    }

    // var scroll = document.getElementsByClassName('scroll')[0]
    // scroll.scrollTop = scroll.scrollHeight


})

onUnmounted(() => {
    Echo.leave('channel_for_everyone')
})

const sendMessage = (content) => {

    const f = useForm({
        chat_room_id: props.selectedRoomId,
        content: content,
    })

    f.post(route('chat.store'), {
        onSuccess: () => {
            form.reset()
            scrollToBottom();
        }
    })
}


</script>

<template>
    <div class="flex flex-col w-[550px] max-h-[400px]">
        <div class="flex overflow-auto flex-col scroll-smooth    pb-14" ref="scroll">
            <div v-for="message in messages">
                <div class="flex  gap-2.5 ">
                    <img class="w-8 h-8 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Jese image">
                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ message.user.name
                                }}</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">11:46</span>
                            <span v-if="message.user_id == $page.props.auth.user.id"
                                class="text-gray-500 dark:text-gray-400">
                                <DotIcon color="green" size="40px" />
                            </span>
                        </div>
                        <div
                            class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                            <p class="text-sm font-normal text-gray-900 dark:text-white"> {{ message.content }}</p>
                        </div>
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
                    </div>
                    <button id="dropdownMenuIconButton" :data-dropdown-toggle="message.id"
                        data-dropdown-placement="bottom-start"
                        class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600"
                        type="button">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                            <path
                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </button>
                    <div :id="message.id"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownMenuIconButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reply</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Forward</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <span ref="scrolll"></span>
        </div>
        <div v-if="messages" class="" @submit.prevent="sendMessage(form.content)">
            <form class="max-w-xs mx-auto">

                <div class="relative flex z-0">
                    <input type="text" id="message" v-model="form.content"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " />
                    <label for="message"
                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                        message
                    </label>
                    <button type="submit" v-if="form.content">
                        <Send />
                    </button>
                </div>
            </form>
        </div>


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