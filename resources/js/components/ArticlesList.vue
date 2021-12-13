<template>
    <div>
        <v-card class="mb-3"
            v-for="article in getArticles"
            :key="article.id"
        >
            <v-card-title v-text="article.title"></v-card-title>
            <v-card-text v-html="article.content"></v-card-text>
            <v-divider class="mx-4"></v-divider>
            <v-card-title v-if="article.categories && article.categories.primary">
                {{ article.categories.primary }}
            </v-card-title>
            <v-card-text>
                <v-chip-group
                    v-if="article.categories.additional"
                    active-class="deep-purple accent-4 white--text"
                    column
                >
                    <v-chip
                        v-for="additional in article.categories.additional"
                        :key="additional"
                    >
                        {{ additional }}
                    </v-chip>
                </v-chip-group>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'

const { mapActions, mapGetters } = createNamespacedHelpers('articles')

export default {
    data: () => ({}),
    computed: {
      ...mapGetters(['getArticles'])
    },
    mounted() {
        this.findArticles()
    },
    methods: {
        ...mapActions(['findArticles'])
    }
}
</script>
