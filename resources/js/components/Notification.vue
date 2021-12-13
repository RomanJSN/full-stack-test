<template>
    <div>
        <v-snackbar v-model="getMassage.show">
            {{ getMassage.text }}
            <template v-slot:action="{ attrs }">
                <v-btn
                    color="red"
                    text
                    v-bind="attrs"
                    @click="removeMessage"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'

const { mapGetters, mapMutations } = createNamespacedHelpers('notification')

export default {
    name: 'Notification',
    data: () => ({}),
    computed: {
        ...mapGetters(['getMassage'])
    },
    methods: {
        ...mapMutations(['removeMessage'])
    }
}
</script>

