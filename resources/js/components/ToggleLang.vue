<template>
    <v-btn-toggle
        v-model="locale"
        dense
    >
        <v-btn
            text
            :value="LOCALE_RU"
            @click="$i18n.locale = LOCALE_RU"
        >
            РУ
        </v-btn>
        <v-btn
            text
            :value="LOCALE_EN"
            @click="$i18n.locale = LOCALE_EN"
        >
            EN
        </v-btn>
    </v-btn-toggle>
</template>

<script>

const LOCALE_RU = 'ru'
const LOCALE_EN = 'en'

export default {
    name: 'ToggleLang',
    data: () => ({
        LOCALE_RU,
        LOCALE_EN,
        locale: LOCALE_RU
    }),
}
</script>
