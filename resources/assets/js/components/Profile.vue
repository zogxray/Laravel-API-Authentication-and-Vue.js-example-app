<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>
                        <div v-if="item" class="panel panel-default">
                            <div class="panel-body">
                                {{item.email}}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if(!this.$root.access) {
                this.$router.push('/');
            } else {
                this.getProfile()
            }
        },
        data: function() {
            return{
                item: null
            }
        },
        methods: {
            getProfile: function () {
                var self = this
                axios.get('api/user/profile', self.$root.access)
                        .then(function (response) {
                            self.item = response.data.item
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }
        }
    }
</script>
