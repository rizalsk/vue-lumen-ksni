<template>
    <div class="container-fluid my-2">
        <div class="row">
            <div class="col min-vh-50 ">
                <div class="card" >
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <router-link class="btn-link" to="/formdata">Formdata</router-link>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            </ol>
                        </nav>

                        <div class="card">
                            <div class="card-body">
                                <span>Form Fields</span>
                                <hr>
                                <button class="btn btn-sm btn-info m-1" v-for="(field, index) in formdata" :key="`field-${index}`" @click="addField(field.id)">
                                    + {{ field.title }}
                                </button>
                            </div>
                        </div>

                        <form action="" @submit.prevent="submitForm" >
                        
                            <div class="card">
                                <div class="card-body">

                                    <v-text-field
                                        label="Family Card ID"
                                        readonly
                                        :rules="rules.family_card_id"
                                        v-model="citizen.family_card_id"
                                    ></v-text-field>

                                    <div class="row m-0 p-0">
                                        <div class="col-12">
                                            <fieldset>
                                                <legend>Formdata:</legend>
                                                <div class="col-12 col-md-12 p-3" v-for="(detail, index) in citizen.formData" :key="`details-${index}`">
                                                    <div class="row m-0 p-0">
                                                        <div class="col-11 d-flex justify-content-center align-items-center" >

                                                            <TextField  
                                                                @on-input="updateFormData" :data="detail" 
                                                                :fieldrules="rules[detail.datatype]" 
                                                                :index="index" 
                                                                
                                                                v-if=" detail.datasource === 'text' "
                                                            />

                                                            <TextAreaFieldVue 
                                                                @on-input="updateFormData" 
                                                                :data="detail" 
                                                                :fieldrules="rules[detail.datasource]"
                                                                :index="index"
                                                                v-if=" detail.datasource === 'text-area' " 
                                                            />

                                                            <DateField 
                                                                @on-input="updateFormData"
                                                                
                                                                :data="detail" 
                                                                :fieldrules="rules[detail.datatype]"
                                                                :index="index" 
                                                                v-if=" detail.datasource === 'date' "
                                                            />

                                                            <ComboboxField 
                                                                @on-input="updateFormData" 
                                                                :data="detail" 
                                                                :index="index"
                                                                :fieldrules="rules[detail.datatype]"
                                                                v-if=" detail.datasource == 'combobox' "
                                                            />

                                                            <RadioboxField 
                                                                @on-input="updateFormData" 
                                                                :data="detail" 
                                                                :index="index" 
                                                                :fieldrules="rules.radio" 
                                                                v-if=" detail.datasource == 'radiobox' "
                                                            />

                                                        </div>
                                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                                            <button type="button" class="btn btn-sm btn-danger rounded-circle" @click="removeField(index)">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-block btn-primary" :class="[ citizen.formData?.length === 0 ? 'disabled' : '' ]">SIMPAN FORMDATA</button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import  api from '@/api'
import {errorHandler} from '@/api'
import {notify} from "@/vendor/toaster";

import { ref, reactive, onMounted, watch } from 'vue';
import moment from 'moment';

import TextField from '@/components/fields/TextField.vue';
import TextAreaFieldVue from '@/components/fields/TextAreaField.vue';
import DateField from '@/components/fields/DateField.vue';
import ComboboxField from '@/components/fields/ComboboxField.vue';
import RadioboxField from '@/components/fields/RadioboxField.vue';

import { useRouter, useRoute } from 'vue-router';

//init router
const router = useRouter();

//init route
const route = useRoute();

const props = defineProps({
    loading: {
        Boolean,
        default: false
    }
})

const emit = defineEmits(['toggle-loading'])

const formdata = ref([])
const citizen = reactive({
    'family_card_id' : null,
    formData:[]
})

const rules = {
    'family_card_id' : [
        value => {
            if ( !value || value === null || value === '') return 'field tidak boleh kosong'
            
            if ( value?.length < 9 ) return 'field kurang dari 9 karakter'
            if (/[a-zA-Z]/.test(value)) return 'field hanya bisa diisi nomor.'

            return true
        },
    ],
    'string' : [
        value => {
            if ( !value || value === null || value === '') return 'field tidak boleh kosong'

            const patternCheck =  /[^a-zA-Z0-9 ]/;
            if ( patternCheck.test(value) !== false ) return 'field hanya bisa diisi nomor dan huruf.'
            return true
        },
    ],
    'number' : [
        value => {
            if ( !value || value === null || value === '') return 'field tidak boleh kosong'
            if (/[a-zA-Z]/.test(value)) return 'field hanya bisa diisi nomor.'
            return true
        },
    ],
    'text-area' : [
        value => {
            if ( !value || value === null || value === '') return 'field tidak boleh kosong'
            const patternCheck =  /[^a-zA-Z0-9 <>\/]/;
            if ( patternCheck.test(value) !== false ) return 'field hanya bisa diisi nomor dan huruf.'
            return true
        },
    ],
    'date' : [
        value => {
            if ( !value || value === null || value === '') return 'field tidak boleh kosong'
            
            const d = moment(value, "YYYY-MM-DD", true)
            const isValidDate = d.isValid();
            if (!isValidDate) return 'format tanggal tidak valid.'

            return true
        },
    ],
    'select' : [
        value => {
            if( !value || value?.length === 0 || value === null || value === '') return 'salah satu field harus dipilih!'
            return true
        },
    ],
    'radio' : [
        value => {
            if( !value || value?.length === 0 || value === null || value === '') return 'salah satu field harus dipilih!'

            return true
        },
    ],
};

const fetchFormData = async() => {
    await api.get('/formdata')
    .then(response => {
        formdata.value = response.data.data;
    })
    .catch(errorHandler)
    .finally(()=>{
        emit('toggle-loading', false)
    })
}

const addField = (id) => {
    const findField = formdata.value.find(item => item.id === id)
    const exists = citizen.formData.find(item => item.id === id)
    if(findField){
        if (!exists || exists.length == 0) {
            const cloned = {...findField}
            citizen.formData = [...citizen.formData, ...[cloned] ]
            updateSorting()
        }
    }
}

const removeField = (idx) => {
    if (idx !== -1) {
        citizen.formData.splice(idx, 1);
        updateSorting()
    }
}

const updateFormData = (idx, val, detail) => {
    
}

const updateSorting = () => {
    citizen.formData.forEach(function (value, i) {
        citizen.formData[i].sorting = i + 1;
    });
}

onMounted(async () => {
    emit('toggle-loading', true)
    await fetchFormData()

    //fetch detail data
    await api.get(`/citizen/${route.params.nik}`)
    .then(response => {
        console.log('response.data', response.data.data);
        const result = response.data.data;
        
        //set response data to state
        citizen.family_card_id = result.family_card_id

        let citizenForm = [];

        result.details.forEach(function (field, i) {
            const fieldData = {
                ...field.formdata,
                ...{
                        value: field.value,
                        sorting: field.sorting
                    }
            }
            citizenForm = [ ...citizenForm, ...[fieldData]]
            citizen.formData = [ ...citizenForm ]
        });
    });
})

const submitForm = async (e) => {
    emit('toggle-loading', true)
    await api.put(`/citizen/${route.params.nik}`, citizen)
    .then(response => {
        console.log(response.data.data);
        notify('success', response.data.msg )
        
        if(response.data.code == 200){
            citizen.family_card_id = null;
            //citizen.formData = [...[]];
        }
        
    })
    .catch(errorHandler)
    .finally(()=>{
        emit('toggle-loading', false)
    })
}
</script>