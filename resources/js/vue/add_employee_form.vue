<template>
    <div class="container">
        <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" v-model="employee.first_name" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input class="form-control" type="text" v-model="employee.last_name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" v-model="employee.email">
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input class="form-control" type="text" v-model="employee.phone_number">
        </div>
        <div class="form-group">
            <label>Company</label>
            <select class="form-control" v-model="employee.company_id">
                <option v-for="(item) in companies" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
        <button class="btn btn-primary" @click="is_update==false?createEmployee():editEmployee()" id="button_text">
            {{ is_update == false ? 'Create' : 'Edit' }}
        </button>
    </div>
</template>

<script>
import router from "../router";

export default {
    name: "add_employee_form",
    data: function () {
        return {
            employee: {
                first_name: '',
                last_name: '',
                company_id: '',
                email: '',
                phone_number: ''
            },
            companies: {},
            is_update: false
        }
    },
    methods: {
        createEmployee() {
            if (this.employee.first_name == '') {
                return;
            } else {
                axios.post('/api/employee', this.employee)
                    .then(response => {
                        if (response.status = 201) {
                            router.push('/dashboard/employee');
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },
        editEmployee() {
            if (this.employee.first_name == '') {
                return;
            } else {
                axios.put('/api/employee/' + this.$route.params.id, this.employee)
                    .then(response => {
                        if (response.status = 201) {
                            router.push('/dashboard/employee');
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },
        fetchRoute() {
            if (this.$route.params.id) {
                axios.get('/api/employee/' + this.$route.params.id).then((result) => {
                    if (result.data.employee) {
                        this.employee = result.data.employee;
                        this.is_update = true;
                    }
                })
            }
        },

        fetchCompany() {
            axios.get('/api/company-for-employee').then((result) => {
                this.companies = result.data;
            });
        },
    },
    mounted() {
        this.fetchCompany();
        this.fetchRoute();
    },
}
</script>

<style scoped>

</style>
