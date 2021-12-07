<template>
  <div class="mb-5">
    <v-row>
      <v-col cols="12" sm="6">
        <v-select
          label="Categories"
          hide-details
          outlined
          color="primary"
        ></v-select>
      </v-col>
      <v-col cols="12" sm="6">
        <div class="d-flex align-center">
          <v-text-field
            hide-details
            label="Search in content"
            outlined
          ></v-text-field>
          <v-btn class="ml-2">
            search
          </v-btn>
        </div>
      </v-col>
    </v-row>
  </div>
</template>
