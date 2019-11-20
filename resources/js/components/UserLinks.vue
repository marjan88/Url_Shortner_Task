<template>
    <div>
        <h4>My Links <span v-if="meta">({{ meta.total }})</span></h4>


        <form class="form-inline" @submit.prevent="onSubmit" v-if="isLoggedIn">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" id="inputPassword2" placeholder="Link" v-model="url">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="private" value="0" v-model="privateUrl">
                <label class="form-check-label" for="private">Private</label>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Add</button>
        </form>


        <div v-if="links && links.length">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="order">Sort</label>
                </div>
                <select class="custom-select" id="order" v-model="order" @change="getLinks">
                    <option selected value="DESC">DESC</option>
                    <option value="ASC">ASC</option>
                </select>
            </div>

            <Link v-for="(link, index) in links" :link="link" :key="index"></Link>
        </div>
        <div v-else>
            You have no links...
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import Link from './Link'

    export default {
        name: "Links",
        components: {Link},
        created() {
            this.getLinks();
        },
        data() {
            return {
                order: 'DESC',
                url: null,
                privateUrl: 0
            }
        },
        computed: {
            ...mapGetters({
                links: 'getLinks',
                meta: 'getMeta',
                isLoggedIn: 'isLoggedIn'
            })
        },
        methods: {
            ...mapActions({
                fetchLinks: 'fetchUserLinks',
                addLink: 'addLink'
            }),
            getLinks() {
                let data = {
                    params: {
                        order: this.order,
                        paginate: true
                    }
                }
                this.fetchLinks(data);
            },
            onSubmit() {
                let {url, privateUrl } = this

                this.addLink({url, private: privateUrl}).then((response) => {
                    this.url = null
                })
            }
        }
    }
</script>

<style scoped>

</style>
