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
    <v-skeleton-loader
      v-for="n in 5"
      :key="n"
      :loading="loading"
      height="175"
      type="article"
    >
      <div></div>
    </v-skeleton-loader>
  </member-layout>
</template>

<script>
import memberLayout from "../../../Layouts/memberLayout.vue"
import axios from "axios"
export default {
  props: ["user","suggestions"],
  components: {
    memberLayout
  },
  metaInfo: {
    title: 'View Suggestions'
  },
  data: () => ({
    alldata: null,
    suggestions: null,
    activePost: null,
    perpage: 15,
    loading: true,
  }),
  created() {
    window.addEventListener("scroll", this.handleScroll);
    setTimeout(() => {
      axios
        .get(
          "/api/paginated/suggestions?perpage=" + this.perpage,
          {
            headers: {
              "Content-Type": "application/json",
            }
          }
        )
        .then(response => this.alldata = response.data)
        .then(() => {
          this.suggestions = this.alldata.data;
        //   this.activePost = this.alldata.data[0];
        })
        .then(() => (this.loading = false));
    }, 500);
  },
  methods:{
    handleScroll() {
      if (
        this.getVerticalScrollPercentage() > 50 &&
        this.loading == false &&
        this.alldata.next_page_url !== null
      ) {
        this.loading = true;
        axios
          .get(this.alldata.next_page_url + "&perpage=" + this.perpage, {
            headers: {
              "Content-Type": "application/json",
            }
          })
          .then(response => (this.alldata = response.data))
          .then(() => this.suggestions.push(...this.alldata.data))
          .then(() => (this.loading = false));
      }
    },
    getVerticalScrollPercentage() {
      var p = document.body.parentNode,
        pos =
          ((document.body.scrollTop || p.scrollTop) /
            (p.scrollHeight - p.clientHeight)) *
          100;
      return pos;
    },
  }
}
</script>

<style>

</style>