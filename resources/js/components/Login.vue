<template>
    <div>
        <form class="login" @submit.prevent="onSubmit">
            <h1>Sign in</h1>
            <label>Email</label>
            <input required v-model="email" type="email" placeholder="Name"/>
            <label>Password</label>
            <input required v-model="password" type="password" placeholder="Password"/>
            <hr/>
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {
        name: "Login",
        data() {
            return {
                email: "",
                password: ""
            }
        },
        methods: {
            ...mapActions({
                login: 'login'
            }),
            onSubmit: function () {
                let {email, password} = this

                this.login({
                    email,
                    password
                }).then(() => this.$router.push('/'))
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style scoped>

</style>
