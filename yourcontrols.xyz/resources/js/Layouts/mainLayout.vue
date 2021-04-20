<template>
    <div class="mainLayout">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <inertia-link href="/" class="navbar-brand">
            <img src="/images/icon.png" alt="YourControls" class="logo d-inline-block align-top" height="30" loading="lazy">
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
            <li class="nav-item">
                <inertia-link href="#" class="nav-link">
                INFORMATION
                </inertia-link>
            </li>
            <li class="nav-item">
                <inertia-link href="#" class="nav-link">
                FAQ
                </inertia-link>
            </li>
            <li class="nav-item" :class="{active: path == '/change-log'}">
                <inertia-link href="/change-log" class="nav-link">
                CHANGE LOG
                </inertia-link>
            </li>
            <li class="nav-item" :class="{active: path == '/download'}">
                <inertia-link href="/download" class="nav-link">
                DOWNLOAD
                </inertia-link>
            </li>
            <li class="nav-item">
                <a href="/member-area" class="nav-link">
                MEMBER AREA
                </a>
            </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-lg-0">
            <li class="nav-item">
                <a href="https://www.paypal.com/paypalme/ctam1207" target="_blank" class="nav-link">
                DONATE
                </a>
            </li>
            <li class="nav-item">
                <inertia-link href="#" class="nav-link">
                PARTNERS
                </inertia-link>
            </li>
            <li class="nav-item">
                <a href="https://discord.gg/p7Bzcv3Yjd" target="_blank" class="nav-link">
                DISCORD
                </a>
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
