<template>
    <div class="card text-center custom-container">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <form @submit="loginUser($event)">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" v-model="user.email"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" v-model="user.password"/>
                </div>
                <button class="btn btn-primary" type="submit">Login</button>
            </form>
        </div>
    </div>
</template>

<script>
import Footer_vue from "./footer";
import router from "../router";

export default {
    name: "login",
    data: function () {
        return {
            user: {
                email: '',
                password: ''
            }
        }
    },
    components: {Footer_vue},
    methods: {
        loginUser(event) {
            event.preventDefault();
            axios.post('/api/login', this.user).then((result) => {
                if (result.data.access_token) {
                    this.$toaster.success("Logged in Successfully");
                    localStorage.setItem('user', JSON.stringify(result.data.user));
                    localStorage.setItem('token', result.data.access_token);
                    router.push('/dashboard');
                }
            })
                .catch((error) => {
                    console.log(error)
                    this.$toaster.error(error);
                })
        }
    }
}
</script>

<style scoped>
.custom-container {
    margin: auto;
    width: 50%;
}
</style>
