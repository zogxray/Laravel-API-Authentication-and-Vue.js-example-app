
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('vue-menu', require('./components/Menu.vue'));


const Login = Vue.component('vue-index', require('./components/Login.vue'));
const Notes = Vue.component('vue-notes', require('./components/Notes.vue'));
const NoteCreate = Vue.component('vue-note-create', require('./components/NoteCreate.vue'));
const NoteEdit = Vue.component('vue-note-edit', require('./components/NoteEdit.vue'));
const Profile = Vue.component('vue-profile', require('./components/Profile.vue'));

const routes = [
    { path: '/',  name: 'login', component: Login },
    { path: '/notes',  name: 'notes', component: Notes },
    { path: '/note-create',  name: 'note-create', component: NoteCreate },
    { path: '/note-edit/:noteId',  name: 'note-edit', component: NoteEdit },
    { path: '/profile',  name: 'profile', component: Profile },
]

const router = new VueRouter({
    routes: routes,
})

const app = new Vue({
    router,
    el: '#app',
    data: {
        tokens: null,
        access:null,
        user: null,
    },
    watch: {
        tokens: {
            handler: function () {
                let self = this
                if(self.tokens && self.tokens.access_token) {
                    self.access =  {
                        headers: {'Authorization': "Bearer " + self.tokens.access_token}
                    };
                    localStorage.setItem('test_refresh_token', self.tokens.refresh_token);
                    var refresh_token_interval = setInterval(function(){
                        self.refresh(self.tokens.refresh_token)
                        clearInterval(refresh_token_interval);
                    }, Math.abs((self.tokens.expires_in/60)*(1000*60)));
                }
            },
            deep: true
        }
    },
    mounted: function () {
        if(localStorage.getItem('test_refresh_token')) {
            this.refresh(localStorage.getItem('test_refresh_token'))
        }
    },
    methods:{
        refresh: function (refresh_token) {
            let self = this
            let data = {
                grant_type: 'refresh_token',
                client_id:  1,
                refresh_token: refresh_token,
                client_secret: 'RUARuS0q7Jwd5kYOiCJgnPXCRgjkaXzkYSB9kfj2',
                scope: '*',
            }

            axios.post('/oauth/token', data)
                .then(function (response) {
                    self.tokens = response.data
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }
});
