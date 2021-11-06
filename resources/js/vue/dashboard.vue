<template>
    <div style="display: flex;flex-direction: row">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <router-link class="nav-link link-dark" to="/dashboard/company">Company</router-link>
                </li>
                <li>
                    <router-link class="nav-link link-dark" to="/dashboard/employee">Employee</router-link>
                </li>
            </ul>

        </div>
        <div class="col-lg-10 col-sm-10 col-md-10" >
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
import router from "../router";

const window = Window;
export default {
    name: "dashboard",
    methods: {
        is_active() {
            if (router.name == 'company') {
                return 'active'
            } else {
                return ''
            }

        }
    }
}
</script>

<style scoped>
.active {
    background: gainsboro !important;
}
</style>
