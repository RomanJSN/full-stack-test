<template>
    <v-row>
        <v-col class="d-flex align-center">
            <v-file-input
                v-model="file"
                label="Import Articles JSON"
                hide-details
                dense
                outlined
                show-size
                :error.sync="error"
            ></v-file-input>
            <v-btn
                outlined
                color="indigo"
                class="ml-3"
                @click="uploadFile"
            >
                Import data
            </v-btn>
            <v-snackbar v-model="snackbar.show">
                {{ snackbar.text }}
            </v-snackbar>
        </v-col>
    </v-row>
</template>

<script>
import {createNamespacedHelpers} from 'vuex'
import {ERROR, SUCCESS} from '../constants/message.js'

const {mapActions} = createNamespacedHelpers('articles')

export default {
    data: () => ({
        file: null,
        error: false,
        snackbar: {
            show: true,
            text: SUCCESS
        }
    }),
    methods: {
        ...mapActions(['uploadArticlesData']),
        notify(text) {
            this.snackbar = {show: true, text}
        },
        async uploadFile() {
            if (!this.file) {
                this.error = true
                setTimeout(() => this.error = false, 1000)
                return
            }
            try {
                await this.uploadArticlesData(this.file)
                this.notify(SUCCESS)
            } catch (e) {
                this.notify(ERROR)
            }
        }
    }
}
</script>
