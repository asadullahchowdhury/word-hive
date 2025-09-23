<template>
    <div class="main">
<!--        <Header/>-->
        <router-view/>
<!--        <Footer/>-->
    </div>

</template>

<script>
import Header from "./shared/header.vue";
import Footer from "./shared/footer.vue";

export default {
    components: {
        Header,
        Footer
    },
    data() {
        return {

        }
    }
}
</script>

