<template>
  <member-layout :user="user" :suggestions-page-id="2">
    <v-card>
      <v-card-title primary-title>
        Submit a Suggestion
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col>
            <b>Title:</b>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-text-field
              filled
              v-model="form.title"
              placeholder="Title"
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <b>Description:</b>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-textarea
              filled
              v-model="form.desc"
              placeholder="Description"
              required
            ></v-textarea>
          </v-col>
        </v-row>
        <v-btn @click.stop="submit()">Submit</v-btn>
      </v-card-text>
    </v-card>
  </member-layout>
</template>

<script>
import memberLayout from "../../../Layouts/memberLayout.vue"
export default {
  props: ["user"],
  components: {
    memberLayout
  },
  metaInfo: {
    title: 'Submit a Suggestion'
  },
  data: () => ({
    form: {
      title: "",
      desc: "",
    }
  }),
  methods:{
    submit() {
      var form = this.form
      var data = new FormData()
      data.append('title', form.title || '')
      data.append('desc', form.desc || '')
      this.$inertia.post('/member-area/suggestions/submit', data)
    }
  }
}
</script>

<style>

</style>