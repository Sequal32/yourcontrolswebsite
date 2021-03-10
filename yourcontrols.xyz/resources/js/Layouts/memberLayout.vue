<template>
  <v-app id="inspire" dark>
    <v-navigation-drawer app dark clipped v-model="drawer" dense>
      <v-list>
        <inertia-link as="v-list-item" href="/member-area/" :class="{'v-item--active v-list-item--active': path == '/member-area'}">
          <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>

          <v-list-item-title>Home</v-list-item-title>
        </inertia-link>

        <inertia-link as="v-list-item" href="/member-area/bugs/submit" :class="{'v-item--active v-list-item--active': path == '/member-area/bugs/submit'}">
          <v-list-item-icon>
            <v-icon>mdi-bug-outline</v-icon>
          </v-list-item-icon>

          <v-list-item-title>Submit a Bug Report</v-list-item-title>
        </inertia-link>
        <!-- <v-list-group
          prepend-icon="mdi-bug-outline"
          v-model="bugPageId"
          color="#fff"
        >
          <template v-slot:activator>
            <v-list-item-title>Bugs</v-list-item-title>
          </template>
          <v-list-item link >
            <v-list-item-icon>
              <v-icon>mdi-magnify</v-icon>
            </v-list-item-icon>
            <v-list-item-title>View all reports</v-list-item-title>
          </v-list-item>
          <v-list-item link >
            <v-list-item-icon>
              <v-icon>mdi-magnify-scan</v-icon>
            </v-list-item-icon>
            <v-list-item-title>View my reports</v-list-item-title>
          </v-list-item>
        </v-list-group> -->
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app dark clipped-left dense>
      <v-app-bar-nav-icon @click="drawer = !drawer" class="d-flex d-lg-none"></v-app-bar-nav-icon>
      <v-toolbar-title>Member Area | Your Controls</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-subheader class="d-none d-sm-flex">Welcome, {{user.username}}</v-subheader>
    <v-menu 
      open-on-hover
      bottom
      offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          dark
          v-bind="attrs"
          v-on="on"
          icon
        >
          <v-avatar
            size="32"
            color="black"
          >
              <img :src="user.avatar" :alt="user.username">
          </v-avatar>
        </v-btn>
      </template>
      <v-list>
        <v-list-item link href="/auth/logout">
          <v-list-item-title>Log Out</v-list-item-title>
          <v-list-item-icon>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-icon>
        </v-list-item>
      </v-list>
    </v-menu>
    </v-app-bar>

    <v-main dark>
      <v-container fluid>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  props: ["user","bugPageId"],
  data: () => ({
    drawer: null,
    path: window.location.pathname
  }),
  created() {
    this.$vuetify.theme.dark = true
    console.log(window.location.pathname)
    console.log([document.querySelector("#bootstrapCSS")])
    document.querySelector("#bootstrapCSS").parentNode.removeChild(document.querySelector("#bootstrapCSS"));
    console.log([document.querySelector("#bootstrapCSS")])
  },
  metaInfo:{
    titleTemplate: '%s | Member Area |YourControls'
  },
}
</script>

<style>

</style>