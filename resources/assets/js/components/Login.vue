<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div v-if="!$root.access" class="panel panel-default">
                    <div class="panel-heading">Login or register</div>
                    <div class="panel-body">
                        <form @submit.prevent="userLogin">
                            <div class="form-group">
                                <label for="lemail">Email address</label>
                                <input type="email" class="form-control" id="lemail" placeholder="Email" v-model="login.email">
                                <div v-if="login_errors['email']">
                                    <span v-for="error in login_errors['email']" class="errorMessage">{{ error }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lpassword">Password</label>
                                <input type="password" class="form-control" id="lpassword" placeholder="Password" v-model="login.password">
                                <div v-if="login_errors['password']">
                                    <span v-for="error in login_errors['password']" class="errorMessage">{{ error }}</span>
                                </div>
                            </div>
                            <button @click.prevent="userLogin" type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
                <div v-if="$root.access" class="panel panel-default">
                    <div class="panel-heading">Logout</div>
                    <div class="panel-body">
                        <button @click.prevent="userLogout" type="submit" class="btn btn-default">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component login mounted.')
        },
        data: function() {
            return{
                login: {
                    email: null,
                    password: null,
                },
                login_errors: [],
            }
        },
        methods: {
            userLogin: function () {
                var self = this

                let data = {
                    grant_type: 'password',
                    client_id:  1,
                    client_secret: 'RUARuS0q7Jwd5kYOiCJgnPXCRgjkaXzkYSB9kfj2',
                    redirect_uri: 'http://test.dev/auth/callback',
                    username: self.login.email,
                    password: self.login.password,
                    scope: '*',
                }

                axios.post('/oauth/token', data)
                        .then(function (response) {
                            self.$root.tokens = response.data
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            },
            userLogout: function () {
                var self = this
                axios.post('api/user/logout', {}, self.$root.access)
                        .then(function (response) {
                            if(response.data.status == true) {
                                self.$root.access = null
                                self.$root.tokens = null
                            }
                            if(self.$route.name != 'login') {
                                self.$router.push('/');
                            }
                        })
                        .catch(function (error) {
                            self.errors = error.response.data
                        });
            }
        }
    }
</script>
