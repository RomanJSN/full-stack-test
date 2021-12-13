<template>
    <div class="mb-5">
        <v-row>
            <v-col cols="12">
                <v-select
                    v-model="filterData.categories"
                    :items="getCategories"
                    multiple
                    item-value="id"
                    item-text="name"
                    label="Categories"
                    hide-details
                    dense
                    outlined
                    color="primary"
                ></v-select>
            </v-col>
            <v-col cols="12">
                <div class="d-flex align-center">
                    <v-text-field
                        v-model="filterData.title"
                        hide-details
                        dense
                        label="Search in title"
                        outlined
                    ></v-text-field>
                </div>
            </v-col>
            <v-col cols="12">
                <div class="d-flex align-center">
                    <v-text-field
                        v-model="filterData.content"
                        hide-details
                        dense
                        label="Search in content"
                        outlined
                    ></v-text-field>
                </div>
            </v-col>
            <v-col cols="12">
                <v-btn block outlined @click="search">
                    Search
                </v-btn>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'

const {
    mapGetters: mapGettersCategories,
    mapActions: mapActionsCategories
} = createNamespacedHelpers('categories')

const { mapActions: mapActionsArticles } = createNamespacedHelpers('articles')

export default {
    name: 'Filter',
    data: () => ({
        filterData: {
            categories: [],
            title: '',
            content: ''
        }
    }),
    computed: {
        ...mapGettersCategories(['getCategories'])
    },
    mounted() {
        this.findCategories()
    },
    methods: {
        ...mapActionsCategories(['findCategories']),
        ...mapActionsArticles(['findArticles']),
        search() {
            const params = {}

            for (let filter in this.filterData) {
                if (Array.isArray(this.filterData[filter]) && this.filterData[filter].length) {
                    params[filter] = this.filterData[filter].join(',')
                    continue
                }
                if (this.filterData[filter]) {
                    params[filter] = this.filterData[filter]
                }
            }

            this.findArticles(params)
        }
    }
}
</script>
