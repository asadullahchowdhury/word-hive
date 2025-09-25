<template>
    <div>
        Dashboard


        <a @click="logout" class="block hover:underline text-center font-medium text-cyan-900 my-5 cursor-pointer"
           href="javascript:void(0)">Logout</a>
    </div>
</template>

<script>
import apiService from "../../../../services/apiService.js";

export default {
    data() {
        return {
            loading: false,
            error: null,
        }
    },
    methods: {


        logout() {
            this.loading = true;
            apiService.post('/admin/logout')
                .then(response => {
                    console.log(response)
                    localStorage.removeItem('admin_token');
                    localStorage.removeItem('admin_user');
                    this.$router.push({name: 'admin.login'});
                })
                .catch(error => {
                    this.loading = false;
                    console.log(error.response.data)

                });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
