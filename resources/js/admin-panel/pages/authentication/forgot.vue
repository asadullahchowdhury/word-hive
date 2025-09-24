<template>
    <div class="w-full h-screen flex items-center justify-center bg-gradient-to-bl frq  from-cyan-200 via-cyan-100 to-blue-100 ">
        <!--Login form-->
        <div class="border filter-blur-sm bg-white border-gray-300 p-6 shadow-lg w-full max-w-md rounded-2xl">
            <div class="flex justify-center mb-6">
                <img class="w-30 object-contain" :src="`/images/logo.png`" alt="">
            </div>
            <h2 class="text-xl font-bold mb-6 text-center text-cyan-900">Admin Login</h2>
            <form action="">
                <div class="form-group mb-3">
                    <input type="text" class="w-full rounded-2xl p-3 border transition-all duration-300 focus:ring ring-cyan-900 border-gray-300 outline-0 focus:border-green-950" placeholder="Username">
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="w-full rounded-2xl p-3 border transition-all duration-300 focus:ring ring-cyan-900 border-gray-300 outline-0 focus:border-green-950" placeholder="Password">
                </div>

                <div class="">
                    <button type="button" class="bg-cyan-900 hover:bg-cyan-950 transition-all duration-300 ease-in-out hover:scale-105 cursor-pointer w-full p-3 rounded-2xl text-white font-medium">Login </button>
                </div>


                <a href="javascript:void(0)" class="block hover:underline text-center font-medium text-cyan-900 my-5">Forgot Password?</a>
            </form>
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
