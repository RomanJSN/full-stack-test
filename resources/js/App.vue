<template>
    <component :is="$route.meta.layout ? $route.meta.layout : DEFAULT_LAYOUT">
        <router-view></router-view>
    </component>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import Default from './layouts/default'
import Auth from './layouts/auth'
import { DEFAULT_LAYOUT } from './constants/layout.js'

const { mapActions } = createNamespacedHelpers('auth')

export default {
    name: 'App',
    components: {
        Default,
        Auth
    },
    data: () => ({
        DEFAULT_LAYOUT
    }),
    mounted() {
        this.getUserData()
    },
    methods: {
        ...mapActions(['getUserData'])
    }
}
</script>
