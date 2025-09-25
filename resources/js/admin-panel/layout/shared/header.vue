<template>
    <div class="w-full h-20 p-3 flex items-center justify-between border-b border-gray-300 bg-white">
        <div
            class="p-3 rounded-2xl bg-gray-100 cursor-pointer hover:bg-gray-200 hover:text-cyan-900 hover:scale-105 transition duration-300 ease-in-out">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 18V20H5V18H16ZM21 11V13H3V11H21ZM19 4V6H8V4H19Z"></path>
            </svg>
        </div>

        <!--Search-->
        <div class="form-group relative flex-1 max-w-[500px]">
            <input type="text" placeholder="Search"
                   class="w-full  rounded-2xl p-3 border transition-all duration-300 focus:ring ring-cyan-900 border-gray-300 outline-0 focus:border-green-950">
        </div>

        <div class="flex gap-3 items-center text-center" v-if="user">
            <div class="text-sm">
                {{ user.name }}
                <div class="text-xs text-gray-500">{{ user.email }}</div>
            </div>
            <div class="font-medium w-12 h-12 flex items-center justify-center p-3 rounded-2xl bg-gray-100 mx-4">
                A
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: null,
        }
    },
    mounted() {
        this.user = JSON.parse(localStorage.getItem('admin_user'));
    }

}
</script>
