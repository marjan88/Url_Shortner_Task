<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" v-model="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
            }
        }
    }
</script>

<style scoped>

</style>
