<i18n>
{
    "en": {
        "sign-up": "Sign up",
        "sign-in": "Sign in",
        "registration": "Registration"
    },
    "ru": {
        "sign-up": "Зарегистрироваться",
        "sign-in": "Войти",
        "registration": "Регистрация"
    }
}
</i18n>
<template>
    <v-card
        class="mx-auto mt-15"
        max-width="500"
    >
        <v-card-title>
            {{ $t('registration') }}
        </v-card-title>
        <v-card-text>
            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
            >
                <v-text-field
                    v-model="name"
                    :rules="nameRules"
                    label="Name"
                    prepend-icon="mdi-account-outline"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="email"
                    :rules="emailRules"
                    label="E-mail"
                    prepend-icon="mdi-email-outline"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="password"
                    :rules="passwordRules"
                    label="Password"
                    prepend-icon="mdi-lock-outline"
                    required
                ></v-text-field>
                <v-text-field
                    v-model="confirmPassword"
                    :rules="confirmPasswordRules"
                    label="Confirm Password"
                    prepend-icon="mdi-lock-alert-outline"
                    required
                ></v-text-field>
                <div class="my-5"></div>
                <v-btn
                    block
                    color="primary"
                >
                    {{ $t('sign-up') }}
                </v-btn>
                <v-btn
                    text
                    block
                    to="/login"
                    class="mt-3"
                    color="primary"
                >
                    {{ $t('sign-in') }}
                </v-btn>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: 'register',
    data: () => ({
        valid: true,
        name: '',
        nameRules: [],
        email: '',
        emailRules: [],
        password: '',
        passwordRules: [],
        confirmPassword: '',
        confirmPasswordRules: []
    })
}
</script>

<style scoped>

</style>
