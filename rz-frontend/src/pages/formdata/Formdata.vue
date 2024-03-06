<template>
    <div class="container-fluid my-2">
        <div class="row">
            <div class="col min-vh-50 ">
                <div class="card" >
                    <div class="card-body">

                        <router-link class="btn btn-primary" to="/formdata/new">
                            <i class="bi bi-person-plus"></i>
                        </router-link>
                        <TableVue :citizens="citizens"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade show" id="modal-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
    
                <div class="modal-content">
    
                    <div class="modal-header bg-deep-purple-900 p-2 text-white">
                        <div>
                            <strong class="modal-title" id="staticBackdropLabel">Modal title</strong>
                        </div>
                        <button type="button" class="btn-close" @click="modalForm.hide()" aria-label="Close"></button>
                    </div>
    
                    <div class="modal-body">
                        
                    </div>
    
    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import * as bootstrap from 'bootstrap';
import TableVue from '@/components/formdata/Table.vue';
import  api from '@/api'
import {errorHandler} from '@/api'
import {notify} from "@/vendor/toaster";

export default{
    components:{
        TableVue
    },
    data(){
        return{
            modalForm: null,
            citizens:[],
        }
    },
    mounted() {
        this.modalForm = new bootstrap.Modal(document.getElementById('modal-form'))
        this.fetchAll();
    },
    methods:{
        async fetchAll(){
            this.$emit('toggle-loading', true );
            await this.fetchCitizens()
            this.$emit('toggle-loading', false );
        },
        async fetchCitizens(){
            await api.get('/citizen')
            .then(response => {
                this.citizens = response.data.data;
            })
            .catch(errorHandler)
            .finally(()=>{

            })
        },
    }
}


</script>