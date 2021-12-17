<i18n>
{
    "en": {
        "sign-up": "Sign up",
        "sign-in": "Sign in",
        "registration": "Registration",
        "email": "E-mail",
        "password": "Password",
        "confirm_password": "Confirm Password",
        "name": "Name",
        "required" : {
            "name": "Name is required",
            "password": "Password is required",
            "confirm_password": "Confirm password is required",
            "email": "E-mail is required"
        },
        "valid": {
            "email": "E-mail must be valid"
        }
    },
    "ru": {
        "sign-up": "Зарегистрироваться",
        "sign-in": "Войти",
        "registration": "Регистрация",
        "email": "Почта",
        "password": "Пароль",
        "confirm_password": "Подтвердите пароль",
        "name": "Имя",
        "required" : {
            "name": "Имя обязательное",
            "password": "Пароль обязательный",
            "confirm_password": "Пароль подтверждения обязательный",
            "email": "Почта обязательна"
        },
        "valid": {
            "email": "Почта не валидна"
        }
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
                    :label="$t('name')"
                    prepend-icon="mdi-account-outline"
                    required
                ></v-text-field>

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
                <v-text-field
                    v-model="confirmPassword"
                    :rules="confirmPasswordRules"
                    :label="$t('confirm_password')"
                    type="password"
                    prepend-icon="mdi-lock-alert-outline"
                    required
                ></v-text-field>
                <div class="my-5"></div>
                <v-btn
                    block
                    color="primary"
                    @click="register"
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
import { createNamespacedHelpers } from 'vuex'

const { mapActions } = createNamespacedHelpers('auth')

export default {
    name: 'register',
    data: () => ({
        valid: true,
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
    }),
    computed: {
        nameRules() {
            return [v => !!v || this.$i18n.t('required.name')]
        },
        emailRules() {
            return [
                v => !!v || this.$i18n.t('required.email'),
                v => /.+@.+\..+/.test(v) || this.$i18n.t('valid.email'),
            ]
        },
        passwordRules() {
            return [v => !!v || this.$i18n.t('required.password')]
        },
        confirmPasswordRules() {
            return [v => !!v || this.$i18n.t('required.confirm_password')]
        }
    },
    methods: {
        ...mapActions(['registerUser']),
        async register() {
            if (!this.valid) return
            await this.registerUser({
                name: this.name,
                email: this.email,
                password: this.password
            })

        }
    }
}
</script>

<style scoped>

</style>
