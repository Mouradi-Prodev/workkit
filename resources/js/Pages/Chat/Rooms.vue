<script setup>
import { PlusIcon } from 'lucide-vue-next';


defineProps(['chatRooms','selectedRoomId'])

const emit = defineEmits(['selectRoom'])




const selectRoom = (chatroom) => {
   
    emit(`selectRoom`,chatroom);

};

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
                    <button>
                        <PlusIcon />
                    </button>
                </div>
            </div>
            <div 
            :class="[selectedRoomId == chatroom.id ? 'bg-slate-600 text-white dark:bg-slate-600':'dark:bg-slate-900 hover:bg-slate-600']" 
            class="flex m-2
                    sticky z-10 top-0 text-sm leading-6 font-semibold text-slate-700  p-0  dark:text-slate-300
                    shadow-lg transition ease-in-out  duration-300 items-center sm:rounded-lg justify-center truncate hover:cursor-pointer  hover:text-gray-100 h-10"
                v-for="chatroom in chatRooms" @click="selectRoom(chatroom)">

                {{ chatroom.name }}
            </div>
        </div>




    </div>
</template>