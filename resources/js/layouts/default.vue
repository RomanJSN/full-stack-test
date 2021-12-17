<template>
    <v-app id="inspire">
        <v-app-bar app color="white" flat>
            <v-toolbar-title>Full Stack Test</v-toolbar-title>
        </v-app-bar>

        <v-navigation-drawer
            class="deep-purple accent-4"
            dark
            app
            permanent
        >
            <v-list>
                <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    link
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <v-btn block @click="logout">
                        Logout
                    </v-btn>
                </div>
            </template>
        </v-navigation-drawer>

        <v-main class="grey lighten-3">
            <v-container>
                <slot></slot>
            </v-container>
        </v-main>
        <Notification/>
    </v-app>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'

const { mapActions } = createNamespacedHelpers('auth')

export default {
    name: 'Default',
    data: () => ({
        items: [
            { title: 'Dashboard', icon: 'mdi-view-dashboard' },
            { title: 'Account', icon: 'mdi-account-box' },
            { title: 'Admin', icon: 'mdi-gavel' },
        ],
    }),
    methods: {
        ...mapActions(['logoutUser']),
        async logout() {
            await this.logoutUser()
            this.$router.push({name: 'Login'})
        }
    }
}
</script>

<style scoped>

</style>
