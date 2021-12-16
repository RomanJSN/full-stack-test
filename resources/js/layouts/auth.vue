<template>
    <v-app id="inspire">
        <v-app-bar app color="white" flat>
            <v-toolbar-title>Full Stack Test Auth</v-toolbar-title>
            <v-spacer></v-spacer>
            <ToggleLang />
        </v-app-bar>

        <v-main class="grey lighten-3">
            <v-container>
                <slot></slot>
            </v-container>
        </v-main>
        <Notification/>
    </v-app>
</template>

<script>
import ToggleLang from '../components/ToggleLang.vue'

export default {
    name: 'Auth',
    components: { ToggleLang }
}
</script>

<style scoped>

</style>
