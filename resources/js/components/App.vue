<template>
    <div>

        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Url Shortener</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <router-link class="p-2 text-dark" to="/">Home</router-link>
                <router-link class="p-2 text-dark" to="/my-links" v-if="isLoggedIn">My Links</router-link>
            </nav>
            <router-link class="btn btn-outline-primary" v-if="!isLoggedIn" to="/login">Login</router-link>
            <router-link class="btn btn-outline-primary" v-if="!isLoggedIn" to="/register">Register</router-link>
            <a class="btn btn-outline-primary" v-if="isLoggedIn" href="#" @click.prevent="onLogout">Logout</a>
        </div>

        <div class="container">

            <Notificaitons/>

            <router-view/>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import Notificaitons from './Notificaitons'

    export default {
        name: "App",
        components: {Notificaitons},
        computed: {
            ...mapGetters({
                isLoggedIn: 'isLoggedIn'
            })
        },
        methods: {
            ...mapActions({
                logout: 'logout'
            }),
            onLogout() {
                this.logout().then(() => {
                    this.$router.push('/login')
                })
            }
        },
    }
</script>

<style scoped>

</style>
