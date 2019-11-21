<template>
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="{'disabled': !pagination.prev_page_url}">
                    <a class="page-link" href="#" aria-label="Previous" @click.prevent="switchPage(pagination.current_page-1)">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li
                    v-for="page in parseInt(pagination.last_page)"
                    class="page-item"
                    v-bind:class="{'active': pagination.current_page === page}"
                >
                    <a class="page-link" href="#" @click.prevent="switchPage(page)">{{ page }}</a>
                </li>
                <li v-bind:class="{'disabled': !pagination.next_page_url}">
                    <a class="page-link" href="#" aria-label="Next" @click.prevent="switchPage(pagination.current_page+1)">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'Pages',
        props: {
            pagination: Object,
            for: {
                type: String,
                default: 'default'
            }
        },
        data() {
            return {}
        },
        methods: {
            switchPage(page) {
                if (page < 1 || page > this.pagination.total_pages) {
                    return;
                }
                this.$emit('switchPage', page);
            }
        }
    }
</script>
