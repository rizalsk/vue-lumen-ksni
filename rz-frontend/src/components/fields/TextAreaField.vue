<template>
    <v-textarea 
        :label="props.data.title"
        required
        :rules="fieldrules"
        v-model="props.data.value"
        @input="emit('on-input', index, fieldValue, data)"
    ></v-textarea>
</template>

<script setup>
    import {errorHandler} from '@/api'
    import { formDefault } from '@/utils/formDefault';
    import { ref, reactive, computed, onMounted, watch } from 'vue';

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
    })
</script>