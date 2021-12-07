<template>
  <v-app id="inspire">
    <v-app-bar
      app
      color="white"
      flat
    >
      <v-toolbar-title>Full Stack Test</v-toolbar-title>
    </v-app-bar>

    <v-main class="grey lighten-3">
      <v-container>
        <v-row class="d-flex justify-center">
          <v-col>
            <Filters />
            <v-sheet
              min-height="70vh"
              rounded="lg"
              class="pa-3"
            >
              <ArticlesList />
            </v-sheet>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import ArticlesList from './components/ArticlesList.vue'
import Filters from './components/Filters.vue'
export default {
  name: 'App',
  components: { ArticlesList, Filters },
  data: () => ({
    links: [
      'Dashboard',
      'Messages',
      'Profile',
      'Updates',
    ],
  }),
}
</script>
