<template>
<div>
    <!-- trigger -->
    <div class="dropdown" @click="isOpen = !isOpen">
        {{ name }}
    </div>
    <!-- menu -->
    <div v-show="isOpen"
        class="position-absolute card mt-3"
        style="width:150px"
    >
        <a href="/user/setting" class="dropmenu text-decoration-none">Setting</a>
        <li class="dropmenu" @click="logout">Logout
            <slot></slot>
        </li>
    </div>
</div>
</template>
<style lang="sass" scoped>
.dropdown 
    cursor: pointer

.dropmenu
    cursor: pointer
    padding: 10px 0
    text-align: start
    color: grey
    &:hover 
        background: rgba(0, 0, 0, 0.1)
</style>

<script>
    export default {
        props: {
            name,
        },
        data(){
            return {
                isOpen: false,
            }
        },
        methods: {
            logout(){
                document.getElementById('logout-form').submit();
            }
        }
    }
</script>

