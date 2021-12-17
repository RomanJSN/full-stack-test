<template>
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
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import UploadArticlesData from "../components/UploadArticlesData";
import ArticlesList from "../components/ArticlesList";
import Filters from "../components/Filters";

const { mapGetters } = createNamespacedHelpers('articles')

export default {
    name: "Index",
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

<style scoped>

</style>
