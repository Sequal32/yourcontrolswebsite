<template>
    <main-layout use-container>

        <div class="row justify-content-center">
            <div class="col col-lg-8">
                <h3>Login</h3>
            </div>
            <div class="col col-lg-8">
                <form>
                    <div class="form-group">
                        <label for="FormInputEmail">Email address</label>
                        <input type="email" class="form-control" :class="{'is-invalid': errors.email}" id="FormInputEmail" v-model="form.email">
                        <div class="invalid-feedback" v-if="errors.email">
                            {{ errors.email }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FormInputPassword">Password</label>
                        <input type="password" class="form-control" :class="{'is-invalid': errors.password}" id="FormInputPassword" v-model="form.password">
                        <div class="invalid-feedback" v-if="errors.password">
                            {{ errors.password }}
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary w-100" @click.stop="submit()">Login</button>
                    <br>
                    <br>
                    <br>
                </form>
            </div>
            <div class="hrdivider">
                <hr/>
                <span>Or</span>
            </div>
            <div class="col col-lg-8">
                <br>
                <div class="row justify-content-center">
                    <inertia-link href="/" class="col-6 text-dark" style="text-align:center">
                        <h6>
                            <i class="fab fa-discord"></i> Login with Discord
                        </h6>
                    </inertia-link>
                </div>
                <br>
                <div class="row justify-content-center">
                    <inertia-link href="/" class="col-4 text-dark" style="text-align:center">
                    <h6>
                        <i class="fab fa-google"></i> Login with Google
                    </h6>
                    </inertia-link>
                </div>
                <br>
                <div class="row justify-content-center">
                    <inertia-link href="/" class="col-4 text-dark" style="text-align:center;">
                    <h6>
                        <i class="fab fa-github"></i> Login with GitHub
                    </h6>
                    </inertia-link>
                </div>
            </div>
        </div>
    </main-layout>
</template>

<script>
import axios from 'axios';
import mainLayout from "../../Layouts/mainLayout.vue";

export default {
    props: ["errors","error"],
    components: {
        mainLayout
    },
    metaInfo: {
        title: "Register"
    },
    data: () => ({
        form: {
            email: '',
            password: '',
        }
    }),
    created() {},
    methods: {
        submit() {
            this.$inertia.post('/login/email', this.form)
        }
    }
};
</script>

<style lang="scss" scoped>
.hrdivider {
    position: relative;
    margin-top: 1rem;
    margin-bottom: 20px;
    width: 100%;
    text-align: center;
    hr {
        margin-top: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.5);
    }
    span {
        position: absolute;
        top: -11px;
        background: rgb(248, 250, 252);
        padding: 0 20px;
        font-weight: bold;
        font-size: 16px;
        transform: translateX(-50%);
    }
}
</style>
