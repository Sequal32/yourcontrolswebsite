<template>
  <member-layout :user="user" :bugs-page-id="1">
    <div v-for="bug in bugs" :key="bug.snowflake">
      <v-card>
        <v-card-title >
          {{bug.title}}
        </v-card-title>
        <v-card-text>
          {{bug.desc}}
          <br>
          <br>
          <div class="steps">
            <div v-for="step in bug.steps" :key="step.index">
              <h3>Step {{step.index}}</h3>
              <div>{{step.value}}</div>
            </div>
          </div>
          <v-subheader>Bug report by {{bug.user.username}}</v-subheader>
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
  props: ["user","bugs"],
  components: {
    memberLayout
  },
  metaInfo: {
    title: 'View Bugs'
  },
  data: () => ({
    alldata: null,
    bugs: null,
    activePost: null,
    perpage: 15,
    loading: true,
  }),
  created() {
    window.addEventListener("scroll", this.handleScroll);
    setTimeout(() => {
      axios
        .get(
          "/api/paginated/bugs?perpage=" + this.perpage,
          {
            headers: {
              "Content-Type": "application/json",
            }
          }
        )
        .then(response => this.alldata = response.data)
        .then(() => {
          this.alldata.data.forEach(data => {
            data.steps = JSON.parse(data.steps)
          });
          this.bugs = this.alldata.data;
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
          .then(() => this.bugs.push(...this.alldata.data))
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

<style lang="scss" scoped>
.steps {
  display: flex;
  justify-content: space-between;
}
</style>
