<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Notes
                        <router-link :to="{ name: 'note-create'}">
                           ( Create Note )
                        </router-link>
                    </div>

                    <div v-if="items">
                        <div v-for="item in items.data">
                            <div class="panel panel-default">
                                <div class="panel-heading"> {{item.title}}
                                    <router-link :to="{ name: 'note-edit', params: {noteId: item.id}}">
                                        ( Edit Note )
                                    </router-link>
                                </div>

                                <div class="panel-body">
                                    {{item.description}}
                                </div>
                            </div>
                        </div>
                        <pagination :data="items" v-on:pagination-change-page="getNotes"></pagination>
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
                this.getNotes()
            }
        },
        data: function() {
            return{
                items: null
            }
        },
        methods: {
            getNotes: function (page) {
                var self = this
                if (typeof page === 'undefined') {
                    page = 1;
                }
                axios.get('api/note/index?page=' + page, self.$root.access)
                        .then(function (response) {
                            self.items = response.data.items
                        })
                        .catch(function (error) {
                            this.$router.push('/');
                        });
            }
        }
    }
</script>
