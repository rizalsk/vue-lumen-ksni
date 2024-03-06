<template>
    <div class="w-100">
        <v-menu
            v-model="menu"
            :close-on-content-click="false"
            transition="scale-transition"
            max-width="290px"
            min-width="290px"
            >
            <template v-slot:activator="{ props }">
                <v-text-field
                    color="secondary"
                    :label="data.title"
                    required
                    :rules="fieldrules"
                    hint="YYYY-MM-DD"
                    persistent-hint
                    v-model="data.value"
                    prepend-inner-icon="mdi-calendar"
                    clearable
                    outlined
                    readonly
                    v-bind="props"
                    @click:clear="() => {dateVal = null; dateDisplay = null}"
                ></v-text-field>
            </template>
            <v-date-picker first-day-of-week="1" v-model="dateVal"                           @change="revocated_at = picker_date" no-title                                 @input="menu_revoke_date1= false">
            </v-date-picker>
        </v-menu>

    </div>
</template>

<script>
import {formatDateString} from "@/vendor/moment";
import moment from 'moment';

export default {
    props: ['index', 'data', 'fieldrules'],
    data() {
        return {
            menu: false,
            dateVal: null,
            dateDisplay: null,
            minDate: "2000-01-05",
        };
    },
    mounted() {
        const newDate = moment(this.data.value, 'YYYY-MM-DD', true);
        this.dateVal = newDate.isValid() ? newDate : null;
    },
    computed: {
    },
    methods: {
        
    },
    watch: {
        dateVal(val){
            this.menu = false;
            this.data.value = formatDateString(val, "YYYY-MM-DD")
            this.$emit('on-input', this.index, this.dateDisplay, this.data );
        }
    } 
};
</script>