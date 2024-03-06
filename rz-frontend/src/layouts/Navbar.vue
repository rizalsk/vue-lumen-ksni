<template>
    <header data-bs-theme="light">
        <nav class="navbar navbar-expand-md bg-light shadow sticky-top border-bottom" data-bs-theme="light">
            <div class="container-fluid">
                <router-link class="navbar-brand" to="/">
                    <img alt="Vue logo" class="logo" src="@/assets/nabati_logo.svg" width="50" />
                    Nabati
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end w-100" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
                    <div class="offcanvas-header">
                        <img alt="Vue logo" class="logo" src="@/assets/nabati_logo.svg" width="50" />
                        <h5 class="offcanvas-title" id="offcanvasLabel">Nabati</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav flex-grow-1 align-items-center justify-content-sm-center justify-content-md-start">
                            <li v-for="(nav, index) in navs" class="nav-item" :key="`nav-${index}`">
                                <router-link :to="nav.path" class="nav-link" :class="[ currentpath == nav.path || currentpath.replace(/\//g, '').includes(nav.title.replace(/\//g, '').toLowerCase()) ? 'active' : '' ]" >
                                    {{ nav.title }}
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    props: ['currentpath'],
    data() {
        return {
            navs : [
                {
                    'title': 'Home',
                    'path': '/',
                },
                {
                    'title': 'Formdata',
                    'path': '/formdata',
                }
            ]
        };
    },
    mounted() {
        
    },
    watch: {
        currentpath(val){
        }
    } 
};
</script>

<style>
.active{
    font-weight: 600;
    color: #ed1c25;
}
</style>