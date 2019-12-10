<template>
    <div>
        <h4>Register</h4>
        <div v-if="error">{{ error }}</div>

        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <label for="email">Name</label>
                <input type="text" v-model="name" class="form-control" id="name"  placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" v-model="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password">Password Confirmation</label>
                <input type="password" v-model="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password Confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
</template>

<script>
    import {mapActions} from 'vuex'
    export default {
        name: "Register",
        data() {
            return {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                error: null
            }
        },
        methods: {
            ...mapActions({
                register: 'register'
            }),
            onSubmit: function () {
                this.error = null
                let data = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }
                this.register(data)
                    .then(() => this.$router.push('/login'))
            }
        }
    }
</script>

<style scoped>

</style>
