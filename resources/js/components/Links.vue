<template>
    <div>
        <h4>Links <span v-if="meta">({{ meta.total }})</span></h4>

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
            <pages v-if="meta" for="links" :pagination="meta" v-on:switchPage="changePage"></pages>
        </div>
        <div v-else>
            There are no links...
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import Link from './Link'
    import Pages from './Pages'

    export default {
        name: "Links",
        components: {Link, Pages},
        created() {
            this.getLinks();
        },
        data() {
            return {
                order: 'DESC',
                url: null,
                privateUrl: 1
            }
        },
        computed: {
            ...mapGetters({
                links: 'getLinks',
                meta: 'getMeta'
            })
        },
        methods: {
            ...mapActions({
                fetchLinks: 'fetchLinks',
                addLink: 'addLink'
            }),
            getLinks(page) {
                let data = {
                    params: {
                        order: this.order,
                        paginate: true
                    }
                }

                if(page) {
                    data.params.page = page
                }

                this.fetchLinks(data);
            },
            onSubmit() {
                let {url, privateUrl } = this

                this.addLink({url, private: privateUrl}).then((response) => {
                    this.url = null
                })
            },
            changePage(page) {
                this.getLinks(page)
            }
        }
    }
</script>

<style scoped>

</style>
