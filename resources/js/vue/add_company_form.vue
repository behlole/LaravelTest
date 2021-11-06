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
        <div class="form-group">
            <label>Website</label>
            <input class="form-control" type="text" v-model="company.website">
        </div>
        <div class="form-group">
            <label>Logo</label>
            <input class="form-control" type="file" v-on:change="onFileChange">
        </div>
        <button class="btn btn-primary" @click="is_update==false?createCompany():editCompany()" id="button_text">
            {{ is_update == false ? 'Create' : 'Edit' }}
        </button>
    </div>
</template>

<script>
import router from "../router";


export default {
    name: "add_company_form",
    data: function () {
        return {
            company: {
                name: '',
                website: '',
                email: '',
                logo_url: '',
            },
            is_update: false,
        }
    },
    methods: {
        createCompany() {
            if (this.company.name == '') {
                return;
            } else {
                let data = this.createFormData();
                axios.post('/api/company', data.form_data, data.config)
                    .then(response => {
                        if (response.status = 201) {
                            this.company.name = '';
                            router.push('/dashboard/company');
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },
        editCompany() {
            if (this.company.name == '') {
                return;
            } else {
                let data = this.createFormData();
                axios.post('/api/company/update/' + this.$route.params.id, data.form_data, data.config)
                    .then(response => {
                        if (response.status = 201) {
                            this.company.name = '';
                            router.push('/dashboard/company');
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },
        onFileChange(e) {
            this.company.logo_url = e.target.files[0];
        },
        fetchRoute() {
            if (this.$route.params.id) {
                axios.get('/api/company/' + this.$route.params.id).then((result) => {
                    if (result.data.company) {
                        this.company = result.data.company;
                        this.is_update = true;
                    }
                })
            }
        },

        createFormData() {
            let data = {form_data: {}, config: {}};
            let formData = new FormData();
            let config;
            if (this.company.logo_url != undefined && typeof (this.company.logo_url) != 'string') {
                config = {
                    headers: {'content-type': 'multipart/form-data'}
                }

                formData.append('logo_url', this.company.logo_url);
            }

            formData.append('name', this.company.name);
            formData.append('email', this.company.email);
            formData.append('website', this.company.website);
            data.form_data = formData;
            data.config = config;
            return data;
        }
    },
    mounted() {
        this.fetchRoute();
    },
}
</script>

<style scoped>

</style>
