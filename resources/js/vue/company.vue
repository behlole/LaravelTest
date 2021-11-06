<template>
    <div>
        <div style="float:right">
            <router-link class="btn btn-primary" to="/dashboard/create-company" tag="button">Create Company
            </router-link>

        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Website URL</th>
                <th scope="col">Email</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item,index) in companies.data" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ item.name }}</td>
                <td>{{ item.website }}</td>
                <td>{{ item.email }}</td>
                <td><img v-if="item.logo_url!=null" :src="'/storage/'+item.logo_url"/></td>
                <td>
                    <a style="cursor:pointer" @click="deleteCompany(item.id)"><i class="fa fa-trash"
                                                                                 aria-hidden="true"></i></a>
                    <a style="cursor: pointer" @click="editCompany(item.id)"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <pagination :data="companies" @pagination-change-page="getResults"></pagination>

    </div>
</template>

<script>
import router from "../router";

export default {
    name: "company",
    data: function () {
        return {
            companies: {},
        }
    },
    methods: {
        getResults(page = 1) {
            axios.get('/api/company?page=' + page)
                .then(response => {
                    this.companies = response.data.companies;
                });
        },
        deleteCompany(id) {
            axios.delete('/api/company/' + id).then((result) => {
                this.companies = result.data.companies
            })
        },
        editCompany(id) {
            router.push('/dashboard/create-company/' + id);
        }
    },
    mounted() {
        this.getResults()
    }
}
</script>

<style scoped>

</style>
