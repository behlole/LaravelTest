<template>
    <div>
        <div style="float:right">
            <router-link class="btn btn-primary" to="/dashboard/create-employee" tag="button">Create Employee
            </router-link>

        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Company Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item,index) in employees.data" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ item.first_name }}</td>
                <td>{{ item.last_name }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.phone_number }}</td>
                <td>
                    <a style="cursor:pointer" @click="deleteEmployee(item.id)"><i class="fa fa-trash"
                                                                                  aria-hidden="true"></i></a>
                    <a style="cursor: pointer" @click="editEmployee(item.id)"><i class="fa fa-pencil"
                                                                                 aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <pagination :data="employees" @pagination-change-page="getResults"></pagination>

    </div>

</template>

<script>
import router from "../router";

export default {
    name: "employee",
    data: function () {
        return {
            employees: {}
        }
    },
    methods: {
        getResults(page = 1) {
            axios.get('/api/employee?page=' + page)
                .then(response => {
                    this.employees = response.data.employees;
                });
        },
        deleteEmployee(id) {
            axios.delete('/api/employee/' + id).then((result) => {
                this.employees = result.data.employees
            })
        },
        editEmployee(id) {
            router.push('/dashboard/create-employee/' + id);
        }
    },
    mounted() {
        this.getResults()
    }
}
</script>

<style scoped>

</style>
