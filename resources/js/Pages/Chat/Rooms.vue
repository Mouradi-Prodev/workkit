<script setup>
import { PlusIcon } from 'lucide-vue-next';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
defineProps(['chatRooms', 'selectedRoomId'])

const emit = defineEmits(['selectRoom'])




const selectRoom = (chatroom) => {

    emit(`selectRoom`, chatroom);

};

const show = ref(false)

const close = () => {
    show.value = false
}

const form = useForm({
    name: '',
})

const createChatRoom = () => {
    form.post(route('chatroom.create'), {
        preserveScroll: true,
        onSuccess: () => {
            close()
        },
        onError: () => {
            alert("Something went wrong!")
        }
    })
}


</script>
<template>
    <div class="flex flex-col w-56 
            max-w-[335px] ">
        <div class="overflow-auto max-h-[400px] ">
            <div class="flex justify-between items-center m-1">
                <div>
                    CONVERSATIONS
                </div>
                <div>
                    <button v-if="$page.props.auth.permissions.chatroom.create" @click="() => { show = true; }">
                        <PlusIcon />
                    </button>
                </div>
            </div>
            <div :class="[selectedRoomId == chatroom.id ? 'bg-slate-600 text-white dark:bg-slate-600' : 'dark:bg-slate-900 hover:bg-slate-600']"
                class="flex m-2
                    sticky z-10 top-0 text-sm leading-6 font-semibold text-slate-700  p-0  dark:text-slate-300
                    shadow-lg transition ease-in-out  duration-300 items-center rounded-lg justify-center truncate hover:cursor-pointer  hover:text-gray-100 h-10"
                v-for="chatroom in chatRooms" @click="selectRoom(chatroom)">

                {{ chatroom.name }}
            </div>
        </div>
    </div>
    <Modal :show="show" @close="close">




        <form @submit.prevent="createChatRoom" class="max-w-md mx-auto mt-6 space-y-6">
            <div class="py-7">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="name" id="name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required v-model="form.name" />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name of the chat room</label>
                    <p v-if="form.errors.name" class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">Oh, snapp!</span>
                        {{ form.errors.name }}.</p>

                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

            </div>
        </form>
    </Modal>
</template>