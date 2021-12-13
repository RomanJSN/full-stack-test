<template>
    <v-row>
        <v-col cols="12" class="d-flex align-center">
            <v-file-input
                v-model="file"
                label="Import Articles JSON"
                hide-details
                dense
                outlined
                show-size
                :error.sync="error"
            ></v-file-input>
        </v-col>
        <v-col cols="12">
            <v-btn
                block
                outlined
                color="indigo"
                :disabled="!file"
                @click="uploadFile"
            >
                Import data
            </v-btn>
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
    }),
    methods: {
        ...mapActions(['uploadArticlesData']),
        uploadFile() {
            const formData = new FormData();
            formData.append('file', this.file);
            this.uploadArticlesData(formData)
        }
    }
}
</script>
