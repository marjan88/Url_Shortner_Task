<template>
    <div class="card">
        <div class="card-body">

            <table class="table">
                <tbody>
                <tr>
                    <td>
                        <a href="#" @click.prevent="onClick(link)">{{link.shortened_url}}</a><br/>
                        <small>{{link.original_url}}</small>
                    </td>
                    <td>Last requested: {{ link.last_used }}</td>
                    <td>Used count: {{ link.used_count }}</td>

                    <td v-if="isLoggedIn && user && link.user_id === user.id">
                        <span v-if="link.private">Private</span>
                        <span v-else>Public</span>
                    </td>

                    <td v-if="isLoggedIn && user && link.user_id === user.id">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent="removeLink(link.code)">X</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name: "Link",
        props: {
            link: {
                type: Object,
                required: true
            }
        },
        computed: {
            ...mapGetters({
                user: 'getUser',
                isLoggedIn: 'isLoggedIn'
            })
        },
        methods: {
            ...mapActions({
                showLink: 'showLink',
                removeLink: 'removeLink'
            }),
            onClick(link) {
                this.showLink(link.code).then((res) => {
                    let { data } = res
                    location.href = data.data
                })
            }
        }
    }
</script>

<style scoped>

</style>
