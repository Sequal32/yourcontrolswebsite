<template>
  <v-app id="inspire" dark>
    <v-navigation-drawer app dark clipped v-model="drawer" dense>
      <v-list>
        <inertia-link as="v-list-item" href="/member-area" :class="{'v-item--active v-list-item--active': path == '/member-area'}" color="#fff">
          <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>

          <v-list-item-title>Home</v-list-item-title>
        </inertia-link>
        
        <v-list-group
          prepend-icon="mdi-bug-outline"
          v-model="bugsPageId"
          color="#fff"
        >
          <template v-slot:activator>
            <v-list-item-title>Bugs</v-list-item-title>
          </template>
          
          <inertia-link as="v-list-item" href="/member-area/bugs/view" :class="{'v-item--active v-list-item--active': path == '/member-area/bugs/view'}" color="#fff">
            <v-list-item-icon>
              <v-icon>mdi-magnify</v-icon>
            </v-list-item-icon>

            <v-list-item-title>View</v-list-item-title>
          </inertia-link>
          <inertia-link as="v-list-item" href="/member-area/bugs/submit" :class="{'v-item--active v-list-item--active': path == '/member-area/bugs/submit'}" color="#fff">
            <v-list-item-icon>
              <v-icon>mdi-pencil</v-icon>
            </v-list-item-icon>

            <v-list-item-title>Submit</v-list-item-title>
          </inertia-link>
        </v-list-group>

        <v-list-group
          prepend-icon="mdi-head-lightbulb-outline"
          v-model="suggestionsPageId"
          color="#fff"
        >
          <template v-slot:activator>
            <v-list-item-title>Suggestions</v-list-item-title>
          </template>
          
          <inertia-link as="v-list-item" href="/member-area/suggestions/view" :class="{'v-item--active v-list-item--active': path == '/member-area/suggestions/view'}" color="#fff">
            <v-list-item-icon>
              <v-icon>mdi-magnify</v-icon>
            </v-list-item-icon>

            <v-list-item-title>View</v-list-item-title>
          </inertia-link>
          <inertia-link as="v-list-item" href="/member-area/suggestions/submit" :class="{'v-item--active v-list-item--active': path == '/member-area/suggestions/submit'}" color="#fff">
            <v-list-item-icon>
              <v-icon>mdi-pencil</v-icon>
            </v-list-item-icon>

            <v-list-item-title>Submit</v-list-item-title>
          </inertia-link>
        </v-list-group>
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
  props: ["user","bugsPageId",
  "suggestionsPageId"],
  data: () => ({
    drawer: null,
    path: window.location.pathname
  }),
  created() {
    this.$vuetify.theme.dark = true
    if (document.querySelector("#bootstrapCSS")) {
      document.querySelector("#bootstrapCSS").parentNode.removeChild(document.querySelector("#bootstrapCSS"));
    }
  },
  metaInfo: {
    titleTemplate: '%s | Member Area |YourControls'
  },
}
</script>

<style>

</style>