<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create note</div>
                    <div class="panel-body">
                        <form @submit.prevent="noteUpdate">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="title" class="form-control" id="title" placeholder="Title" v-model="item.title">
                                <div v-if="errors['title']">
                                    <span v-for="error in errors['title']" class="errorMessage">{{ error }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" placeholder="Description" v-model="item.description"></textarea>
                                <div v-if="errors['description']">
                                    <span v-for="error in errors['description']" class="errorMessage">{{ error }}</span>
                                </div>
                            </div>
                            <button @click.prevent="noteUpdate" type="submit" class="btn btn-default">Submit</button>
                        </form>
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
                this.getNote()
            }
            console.log(this.$route)
        },
        data: function() {
            return{
                item: {
                    title: null,
                    description: null,
                },
                id: this.$route.params.noteId,
                errors: [],
            }
        },
        methods: {
            noteUpdate: function () {
                var self = this
                axios.post('api/note/update/'+self.id, self.item, self.$root.access)
                        .then(function (response) {
                            self.errors = []
                            self.item = response.data.item
                            self.$router.push('/notes');
                        })
                        .catch(function (error) {
                            self.errors = error.response.data
                        });
            },
            getNote: function () {
                var self = this
                axios.get('api/note/show/'+self.id, self.$root.access)
                        .then(function (response) {
                            self.item = response.data.item
                        })
                        .catch(function (error) {
                            self.errors = error.response.data
                        });
            }
        }
    }
</script>
