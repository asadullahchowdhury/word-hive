<template>
    <div
        class="w-full h-screen flex items-center justify-center bg-gradient-to-bl frq  from-cyan-200 via-cyan-100 to-blue-100 ">
        <!--Login form-->
        <div class="border filter-blur-sm bg-white border-gray-300 p-6 shadow-lg w-full max-w-md rounded-2xl">
            <div class="flex justify-center mb-6">
                <img class="w-30 object-contain" :src="`/images/logo.png`" alt="">
            </div>
            <h2 class="text-xl font-bold mb-6 text-center text-cyan-900">Admin Login</h2>
            <form @submit.prevent="login">
                <div v-if="error" class="bg-red-100 p-3 rounded-2xl text-center text-xs text-red-900 mb-3"
                     v-html="error"></div>
                <div class="form-group mb-3">
                    <input type="email" v-model="form.email" name="email"
                           class="w-full rounded-2xl p-3 border transition-all duration-300 focus:ring ring-cyan-900 border-gray-300 outline-0 focus:border-green-950"
                           placeholder="Email">
                </div>
                <div class="form-group mb-3">
                    <input type="password" v-model="form.password" name="password"
                           class="w-full rounded-2xl p-3 border transition-all duration-300 focus:ring ring-cyan-900 border-gray-300 outline-0 focus:border-green-950"
                           placeholder="Password">
                </div>

                <div class="">
                    <button type="submit"
                            class="bg-cyan-900 hover:bg-cyan-950 transition-all duration-300 ease-in-out hover:scale-105 cursor-pointer w-full p-3 rounded-2xl text-white font-medium">
                        Login
                        <span v-if="loading"
                              class="border-t border-white animate-spin ml-2 w-5 h-5 rounded-full inline-block"></span>
                    </button>
                </div>


                <router-link :to="{name: 'admin.forgot-password'}"
                             class="block hover:underline text-center font-medium text-cyan-900 my-5">Forgot Password?
                </router-link>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            loading: false,
            error: null,
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        login() {
            this.loading = true;
            axios.post('/api/admin/login', this.form)
                .then(response => {
                    this.loading = false;
                    localStorage.setItem('admin_token', response.data.token);
                    localStorage.setItem('admin_user', JSON.stringify(response.data.user));
                    this.$router.push({name: 'admin.dashboard'});
                })
                .catch(error => {
                    this.loading = false;
                    console.log(error.response.data)
                    localStorage.setItem('admin_token', error.response.data.token);
                    this.error = error.response.data.message;
                })
        }
    }
}
</script>
