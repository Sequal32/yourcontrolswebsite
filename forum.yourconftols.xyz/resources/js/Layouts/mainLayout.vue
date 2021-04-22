<template>
    <div class="mainLayout">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <inertia-link href="/" class="navbar-brand">
                <img src="/images/logo.png" alt="YourControls" class="logo d-inline-block align-top" height="30" loading="lazy">
            </inertia-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item" :class="{active: path == '/'}">
                        <inertia-link href="/" class="nav-link">
                        HOME
                        </inertia-link>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0" v-if="user">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Weilcome, {{user.username}}</a>
                        <div class="dropdown-menu">
                            <inertia-link class="dropdown-item" href="/logout">Logout</inertia-link>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0" v-else>
                    <li class="nav-item" :class="{active: path == '/login'}" v-if="!user">
                        <inertia-link href="/login" class="nav-link">
                        login
                        </inertia-link>
                    </li>
                    <li class="nav-item" :class="{active: path == '/register'}" v-if="!user">
                        <inertia-link href="/register" class="nav-link">
                        Register
                        </inertia-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="page" :class="{container: useContainer}">
            <slot />
        </div>
    </div>
</template>

<script>
import '../plugins/bootstrap'

export default {
    name: 'MainLayout',
    props:{
        useContainer:{
            default: false,
            type: Boolean,
        },
        user: {
            type: Object | false
        }
    },
    data: () => ({
        path: window.location.pathname
    }),
    metaInfo:{
        titleTemplate: '%s | YourControls'
    },
}
</script>

<style lang="scss">
.mainLayout{
    min-height: 100%;
    background-color: #f8fafc;
    .navbar {
        background-color: #f8f9fa;
        .navbar-collapse{
            .navbar-nav{
                .nav-item{
                    &.active{
                        .nav-link{
                        color: #000000e6;
                        }
                    }
                    .nav-link{
                        color: #00000080;
                    }
                }
            }
        }
    }
}
</style>
