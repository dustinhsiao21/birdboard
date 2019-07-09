<template>
    <modal name="project-delete-modal" classes="card p-4" height="auto">
        <form @submit.prevent="submit">
            <h4 class="card-header">Would you like to delete this project?</h4>
            <footer class="card-body text-right">
                <button type="button" class="btn btn-outline-danger mx-2" @click="$modal.hide('project-delete-modal')">Cancel</button>
                <button type="submit" class="btn btn-success mx-2">Delete Project</button>
            </footer>
            <div class="card-footer" v-if="errors.length > 0">
                <p class="text-danger" v-for="(error, index) in errors" v-text="error" :key="index"></p>
            </div>
        </form>
    </modal>
</template>

<script>
    export default {
        props: {
            projectId: {
                type: Number,
                default: 0,
                required: true
            }
        },
        data(){
            return {
                errors: [],
            }
        },
        methods: {
            submit() {
                console.log(this.projectId);
                axios.post('/projects/' + this.projectId + '/delete')
                    .then(response => {
                        location = response.data;
                    })
                    .catch(errors => {
                        this.errors = errors.response.data.errors;
                    })
            }
        }
    }
</script>
