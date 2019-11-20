<template>
    <div v-if="notification" class="alert" :class="'alert-'+notification.status" role="alert">
        {{ notification.message }}
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "Notificaitons",
        computed: {
            ...mapGetters({
                notification: 'notification'
            })
        }
    }
</script>

<style scoped>

</style>
