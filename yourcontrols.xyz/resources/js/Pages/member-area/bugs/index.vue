<template>
  <member-layout :user="user" bug-page-id="1">
    <v-card>
      <v-card-title primary-title>
        Submit a Bug Report
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
        <v-row>
          <v-col style="line-height: 36px;">
            <b> Steps to reproduce the behavior: </b>
            <div>To add more steps just press the "ADD STEP" button on the right</div>
          </v-col>
          <v-col style="text-align:right">
            <v-btn
              elevation="2"
            @click.stop="addStep()">Add step</v-btn>
          </v-col>
        </v-row>
        <div v-for="(step, index) in form.steps" :key="step.index">
          <v-row>
            <v-col cols="9" sm="10" md="11" lg="11">
              <v-text-field
                filled
                :label="'Step ' + step.index"
                v-model="step.value"
                :autofocus="step.focus"
                @keydown.enter="addStepAndFocusNext()"
              ></v-text-field>
            </v-col>
            <v-col cols="3" sm="2" md="1" lg="1" style="line-height: 65px; text-align:center;">
              <v-btn
                text
                v-if="index != 0"
              @click.stop="removeStep(index)">X</v-btn>
            </v-col>
          </v-row>
        </div>
        <v-row>
          <v-col>
            <div>
              <b>Log files</b>
            </div>
            <div>
              <b>PLEASE ATTACH EVERYONE'S LOGS</b> Log.txt can be found in the directory of the .exe file
            </div>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-file-input
              show-size
              accept=".txt"
              truncate-length="50"
              small-chips
              multiple
              dense
              filled
              :rules="rules.logInput"
              v-model="form.files"
            ></v-file-input>
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
    title: 'Report a Bug'
  },
  data: () => ({
    form: {
      title: "",
      desc: "",
      steps: [
        {
          value: "",
          index: 1,
          focus: false
        }
      ],
      files: null,
    },
    rules: {
      logInput: [
        files => !files || !files.some(file => file.size > 2_097_152) || 'Log File should be less then 2 MB!'
      ]
    }
  }),

  methods: {
    addStep() {
      const l = this.form.steps.length
      const s = {
        value: "",
        index: l + 1,
        focus: false
      }
      this.form.steps.push(s)
    },
    removeStep(i) {
      console.log(i)
      this.form.steps.splice(i, 1)
    },
    addStepAndFocusNext() {
      const l = this.form.steps.length
      const s = {
        value: "",
        index: l + 1,
        focus: true
      }
      this.form.steps.push(s)
    },
    submit() {
      var form = this.form
      var data = new FormData()
      data.append('title', form.title || '')
      data.append('desc', form.desc || '')
      data.append('steps', JSON.stringify(form.steps) || '')
      form.files.forEach((file,index)=>{
        data.append('file_'+index, file || '')
      })
      this.form = {
        title: "",
        desc: "",
        steps: [
          {
            value: "",
            index: 1,
            focus: false
          }
        ],
        files: null
      }
      this.$inertia.post('/member-area/bugs/submit', data)
    }
  }
}
</script>

<style>

</style>