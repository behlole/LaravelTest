<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link class="navbar-brand" to="/">Laravel Employee CRUD APP</router-link>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>
                <div>
                    <router-link class="btn btn-primary" to="/login" tag="button" v-if="!is_logged_in">Login
                    </router-link>
                    <a class="btn btn-primary" to="/login" tag="button" v-if="is_logged_in" @click="logout()">Logout
                    </a>
                </div>

            </div>
        </nav>

    </div>
</template>

<script>
import router from "../router";

export default {
    name: "header_vue",
    data: function () {
        return {
            is_logged_in: false,
        }
    },
    methods: {
        logout() {
            localStorage.clear();
            this.is_logged_in = false;
            this.$toaster.success("Logged Out successfully");
            router.push('/login');
        }
    },
    mounted() {
        if (localStorage.getItem('user')) {
            this.is_logged_in = true;
        } else {
            this.is_logged_in = false;
        }
    }
}
</script>

<style scoped>

</style>
