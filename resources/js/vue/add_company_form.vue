<template>
    <div class="container">
        <div class="form-group">
            <label>Company Name</label>
            <input class="form-control" type="text" v-model="company.name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" v-model="company.email">
        </div>
        <button class="btn btn-bg-primary" @click="createCompany()">Create</button>
    </div>
</template>

<script>
export default {
    name: "add_company_form",
    data: function () {
        return {
            company: {
                name: ''
            }
        }
    },
    methods: {
        createCompany() {
            if (this.company.name == '') {
                return;
            } else {
                axios.post('api/company', this.company)
                    .then(response => {
                        if (response.status = 201) {
                            this.company.name = '';
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }
    }
}
</script>

<style scoped>

</style>
