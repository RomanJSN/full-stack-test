<template>
    <v-app id="inspire">
        <v-app-bar app color="white" flat>
            <v-toolbar-title>Full Stack Test</v-toolbar-title>
        </v-app-bar>

        <v-main class="grey lighten-3">
            <v-container>
                <v-row class="d-flex justify-center">
                    <v-col md="8">
                        <v-sheet
                            min-height="70vh"
                            rounded="lg"
                            class="pa-3"
                            style="position: relative;"
                        >
                            <ArticlesList/>
                            <v-overlay
                                absolute
                                :value="getIsLoading"
                            >
                                <v-progress-circular
                                    indeterminate
                                    size="64"
                                ></v-progress-circular>
                            </v-overlay>
                        </v-sheet>
                    </v-col>
                    <v-col md="4">
                        <Filters/>
                        <UploadArticlesData/>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <Notification/>
    </v-app>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import ArticlesList from './components/ArticlesList.vue'
import Filters from './components/Filters.vue'
import UploadArticlesData from './components/UploadArticlesData.vue'
import Notification from './components/Notification.vue'

const { mapGetters } = createNamespacedHelpers('articles')

export default {
    name: 'App',
    components: {
        UploadArticlesData,
        ArticlesList,
        Filters,
        Notification
    },
    data: () => ({}),
    computed: {
        ...mapGetters(['getIsLoading'])
    }
}
</script>
