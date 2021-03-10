<template>
  <member-layout :user="user" :suggestions-page-id="1">
    <div v-for="suggestion in suggestions" :key="suggestion.snowflake">
      <v-card>
        <v-card-title >
          {{suggestion.title}}
        </v-card-title>
        <v-card-text>
          {{suggestion.desc}}
          <br>
          <br>
          <v-subheader>Suggestion by {{suggestion.user.username}}</v-subheader>
        </v-card-text>
      </v-card>
      <br>
    </div>
  </member-layout>
</template>

<script>
import memberLayout from "../../../Layouts/memberLayout.vue"
export default {
  props: ["user","suggestions"],
  components: {
    memberLayout
  },
  metaInfo: {
    title: 'Submit a Suggestion'
  },
  created() {
    console.log( this.suggestions )
  }
}
</script>

<style>

</style>