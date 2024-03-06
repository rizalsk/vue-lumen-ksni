<template>
    <v-radio-group 
        :label="data.title"
        v-model="props.data.value"
        :rules="fieldrules"
        required
    >
        <v-radio v-for="(field, index) in data.data_parameter" 
            :label="field.name" 
            :value="field.id" 
            :key="`${data.title}-${index}`"
            @input="emit('on-input', index, fieldValue, data)"
        ></v-radio>
    </v-radio-group>

</template>

<script setup>
    import { ref, computed, onMounted, watch } from 'vue';

    // props
    const props = defineProps(['index', 'data', 'fieldrules'])
    // emit
    const emit = defineEmits(['on-input'])

    const fieldValue = ref(null)

    const index = computed(() => {
        return props.index
    })

    const fieldrules = computed(() => {
        return props.fieldrules
    })

    const data = computed(() => {
        return props.data
    })

    onMounted(() => {
        if (props.data.data_parameter?.length){
            props.data.value = props.data.data_parameter[0].id
        }
    })
    
</script>