<template>
    <modal name="project-create-modal" classes="card p-4" height="auto">
        <form @submit.prevent="submit">
            <h3 class="text-center">Let's Start Something New</h3>
            <div class="d-flex justify-content-around mt-4 mx-3">
                <div class="mr-n4">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" v-model="form.title" :class="form.errors.title ? 'is-invalid': ''"/>
                        <small class="text-danger" v-if="form.errors.title" v-text="form.errors.title[0]"></small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description" rows="7" v-model="form.description" :class="form.errors.description ? 'is-invalid': ''"/>
                        <small class="text-danger" v-if="form.errors.description" v-text="form.errors.description[0]"></small>
                    </div>
                </div>
                <div class="ml-n4">
                    <div class="form-group">
                        <label for="title">Tasks</label>
                        <input type="text" name="task" id="task" class="form-control mb-2" placeholder="Task 1" v-for="(task, index) in form.tasks" :key="index" v-model="task.body"/>
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline-dark" @click="add()">add New Tasks</button>
                    </div>
                </div>
            </div>
            <footer class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-danger mx-2" @click="$modal.hide('project-create-modal')">Cancel</button>
                <button type="submit" class="btn btn-primary mx-2">Create Project</button>
            </footer>
        </form>
    </modal>
</template>

<script>
import BirdboardForm from './BirdboardForm';
    export default {
        data() {
            return {
                form: new BirdboardForm({
                    title: '',
                    description: '',
                    tasks: [
                        { body : '' },
                    ]
                }),
            };
        },
        methods: {
            add () {
                this.form.tasks.push({body:''});
            },
            submit() {
                this.form.submit('/projects')
                    .then(response => {
                        location = response.data;
                    });
            }
        }
    }
</script>
