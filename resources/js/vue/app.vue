<template>
    <div class="main-app-container">
        <div class="heading">
            <h2 id="title">Admin Panel</h2>
        </div>
        <add_company_form/>
        <list_company :items="items"></list_company>
    </div>
</template>
<script>
import add_company_form from "./add_company_form";
import list_company from "./list_company";

export default {
    name: "app",
    data: function () {
        return {
            companies: []
        }
    },
    methods: {
        getList() {
            axios.get('api/company').then(
                response => {
                    this.items = response.companies.data
                })
        }
    },
    components: {add_company_form, list_company},
    created: this.getList()

}
</script>
<style scoped>
.main-app-container {
    width: 350px;
    margin: auto;
}

.heading {
    background: #e6e6e6;
}

#title {
    text-align: center;
}
</style>
