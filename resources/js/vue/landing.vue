<template>

    <div class="card text-center custom-container">
        <div class="card-header">
            Welcome to Laravel Test
        </div>
        <div class="card-body">
            <h5 class="card-title">Employee-Company Crud</h5>
            <p class="card-text">Includes functionality of management of employees with respect to companies with
                mailing functionality</p>
            <p class="card-text">Please Login To Continue</p>
            <router-link class="btn btn-primary" to="/login" tag="button">Login</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "landing"
}
</script>

<style scoped>
.custom-container {
    margin: auto;
    width: 50%;
}
</style>
