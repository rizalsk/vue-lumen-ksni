<template>
    <div>
        <div class="d-fex text-center">
            <h5>Data Citizen</h5>
        </div>
        <table class="table table-bordered ">
            <thead class="table-dark">
                <tr>
                    <th scope="col" width="60" class="text-center">#</th>
                    <th scope="col" class="text-center">Family Card ID</th>
                    <th scope="col" class="text-center">FORM DATA</th>
                    <th scope="col" class="text-center">Aksi</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr v-for="(citizen, i) in citizens" :key="`tdcitizen-${i}`">
                    <td>{{ i + 1 }}</td>
                    <td>{{ citizen.family_card_id }}</td>
                    <td>
                        <ul class="list-group">
                            <li v-for="(detail, j) in citizen.details" :key="`detail-${j}`" class="list-group-item">
                                {{ detail.sorting }}. {{ detail.formdata.title }} = {{ detail.value }}
                            </li>
                        </ul>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <router-link class="btn btn-sm btn-warning" :to="`formdata/edit/${citizen.family_card_id}`">
                                <i class="bi bi-pencil-square"></i>
                            </router-link>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    setup() {
        
    },
    components:[
        
    ],
    props:[
        'citizens',
    ],
    mounted() {
    },
}
</script>