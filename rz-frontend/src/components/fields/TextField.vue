<template>
    <v-text-field
        :label="props.data.title"
        required
        :rules="fieldrules"
        v-model="props.data.value"
        @input="onInput"
        ></v-text-field>
</template>

<script setup>
    import { ref, computed, onMounted } from 'vue';

    // props
    const props = defineProps(['index', 'data', 'fieldrules'])
    // emit
    const emit = defineEmits(['on-input'])

    const index = computed(() => {
        return props.index
    })

    const fieldrules = computed(() => {
        return props.fieldrules
    })

    const data = computed(() => {
        return props.data
    })

    const fieldValue = ref(null)

    const onInput = (e) => {
        props.data.value = e.target.value;
        emit('on-input', index, props.data.value, props.data)
    }

    onMounted(() => {
        fieldValue.value = data.value.value
    })
    
</script>