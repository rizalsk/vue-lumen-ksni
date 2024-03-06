
<template>
    <div>
        <Navbar :currentpath="path"/>
        <Loader v-if="isLoading"/>
        <RouterView 
            class="router-view" 
            @toggle-loading="setLoading" 
            :loading="isLoading" 
            v-slot="{Component}">
            <Transition name="page-opacity" mode="out-in" >
                <main :key="route.name" >
                    <component :is="Component" />
                </main>
            </Transition>
        </RouterView>    
        <Footer />
    </div>
</template>

<script setup>
    import { RouterView, useRouter, useRoute } from 'vue-router'
    import { ref,reactive, onMounted, watch } from 'vue';
    import Navbar from "@/layouts/Navbar.vue";
    import Footer from "@/layouts/Footer.vue";
    import Loader from "@/components/Loader.vue";

    const route = useRoute()
    const router = useRouter()
    //define state
    const path = ref("/");
    const isLoading = ref(false);

    const setLoading = (isLoaded) => {
        isLoading.value = isLoaded;
    }

    watch(route, async (newPath, oldPath) => {
        path.value = newPath.path
    })

    onMounted(async () => {
    })
</script>

<style>
    .page-opacity-enter-active,
    .page-opacity-leave-active{
        transition: 400ms ease all;
    }

    .page-opacity-enter-from,
    .page-opacity-leave-to{
        opacity: 0;
    }

</style>