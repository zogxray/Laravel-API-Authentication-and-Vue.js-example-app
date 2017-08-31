<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Navigation</div>
                    <div class="panel-body">
                        <ul class="list-group-horizontal">
                            <router-link v-if="!$root.access" :to="{ name: 'login'}" tag="li">
                                <a>Login</a>
                            </router-link>
                            <router-link v-if="$root.access" :to="{ name: 'notes'}" tag="li">
                                <a>Notes</a>
                            </router-link>
                            <router-link v-if="$root.access" :to="{ name: 'profile'}" tag="li">
                                <a>Profile</a>
                            </router-link>
                            <router-link v-if="$root.access" :to="{ name: 'login'}" tag="li">
                                <a>Logout</a>
                            </router-link>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component menu mounted.')
        }
    }
</script>
