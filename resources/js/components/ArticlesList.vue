<template>
    <div>
        <v-card class="mb-3"
                v-for="n in 10"
                :key="n"
        >
            <v-card-title>Cafe Badilico</v-card-title>
            <v-card-text>
                <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio seating.
                </div>
            </v-card-text>
            <v-divider class="mx-4"></v-divider>
            <v-card-title>Categories</v-card-title>
            <v-card-text>
                <v-chip-group
                    active-class="deep-purple accent-4 white--text"
                    column
                >
                    <v-chip>5:30PM</v-chip>
                </v-chip-group>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    data: () => ({}),
}
</script>
