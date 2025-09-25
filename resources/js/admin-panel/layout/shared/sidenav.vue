<template>
    <div class="w-64 p-3 h-screen flex flex-col  border-r border-gray-300 rounded-r-[50px] bg-white">
        <!--Logo-->
        <div class="flex items-center justify-center mt-4">
            <img class="w-[150px]" :src="`/images/logo.png`" alt="logo">
        </div>

        <!--Menu-->
        <div class="mt-10">
            <ul>
                <li>
                    <router-link :to="{name: 'admin.dashboard'}"
                                 class="font-medium text-cyan-900 flex items-center p-3 rounded-lg hover:bg-gray-100 transition-all duration-300 ease-in-out">
                        Dashboard
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'admin.blogs'}"
                                 class="font-medium text-cyan-900 flex items-center p-3 rounded-lg hover:bg-gray-100 transition-all duration-300 ease-in-out">
                        Blogs
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    setup() {
        return {}
    }
}
</script>

<style lang="scss" scoped>

</style>
