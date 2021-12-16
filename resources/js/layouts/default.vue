<template>
    <v-app id="inspire">
        <v-app-bar app color="white" flat>
            <v-toolbar-title>Full Stack Test</v-toolbar-title>
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
export default {
    name: 'Default'
}
</script>

<style scoped>

</style>
