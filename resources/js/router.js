import Vue from 'vue';
import VueRouter from "vue-router";
import login from "./vue/login";
import dashboard from "./vue/dashboard";
import landing from "./vue/landing";
import company from "./vue/company";
import employee from "./vue/employee";
import add_company_form from "./vue/add_company_form";
import add_employee_form from "./vue/add_employee_form";

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '', component: landing
        },
        {
            path: '/login',
            name: 'login_route',
            component: login,
        },
        {
            path: '/dashboard',
            component: dashboard,
            beforeEnter: (to, from, next) => {
                if (localStorage.getItem('user') != null) {
                    next();
                } else {
                    next({name: 'login_route'})
                }
            },
            children: [
                {path: '', component: company},
                {path: 'company', component: company},
                {path: 'create-company/:id?', component: add_company_form},
                {path: 'create-employee/:id?', component: add_employee_form},
                {path: 'employee', component: employee}
            ]
        }
    ]
})
