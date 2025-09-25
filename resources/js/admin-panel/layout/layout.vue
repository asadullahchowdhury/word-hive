<template>
    <div>

        <div class="flex">
            <sidenav/>
           <div class="w-full">
               <Header/>
               <div class="content-wrap p-3 bg-gray-100 h-[calc(100vh-80px)]">
                   <router-view/>
               </div>
           </div>
        </div>

    </div>
</template>

<script>
import Header from './shared/header.vue';
import sidenav from './shared/sidenav.vue';

export default {
    components: {
        Header,
        sidenav,
    },
    setup() {
        return {}
    }
}
</script>

