<i18n>
{
    "en": {
        "login": "Login",
        "sign-in": "Sign in",
        "sign-up": "Sign up",
        "registration": "Registration",
        "email": "E-mail",
        "password": "Password"
    },
    "ru": {
        "login": "Вход",
        "sign-in": "Войти",
        "sign-up": "Зарегистрироваться",
        "registration": "Регистрация",
        "email": "Почта",
        "password": "Пароль"
    }
}
</i18n>

<template>
    <v-card
        class="mx-auto mt-15"
        max-width="500"
    >
        <v-card-title>
            {{ $t('login') }}
        </v-card-title>
        <v-card-text>
            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
                @submit.prevent="submit"
            >
                <v-text-field
                    v-model="email"
                    :rules="emailRules"
                    :label="$t('email')"
                    prepend-icon="mdi-email-outline"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="password"
                    :rules="passwordRules"
                    :label="$t('password')"
                    type="password"
                    prepend-icon="mdi-lock-outline"
                    required
                ></v-text-field>
                <div class="my-5"></div>
                <v-btn
                    block
                    color="primary"
                    type="submit"
                >
                    {{ $t('sign-in') }}
                </v-btn>
                <v-btn
                    class="mt-3"
                    text
                    block
                    to="/register"
                    color="primary"
                >
                    {{ $t('sign-up') }}
                </v-btn>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';

const { mapActions } = createNamespacedHelpers('auth')

export default {
    name: 'Login',
    data: () => ({
        valid: true,
        email: 'roman.jsn@gmail.com',
        emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
        password: 'Test@test123',
        passwordRules: [
            v => !!v || 'Password is required',
        ],
    }),

    methods: {
        ...mapActions(['loginUser']),
        submit() {
            this.loginUser({
                email: this.email,
                password: this.password
            })
        }
    },
}
</script>
