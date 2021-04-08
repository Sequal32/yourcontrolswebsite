<template>
  <div id="app">
    <div class="img">
      <img src="./assets/logo.png" width="50%" alt="">
      <h2>
        Cloud Server Usage Chart
      </h2>
    </div>
    <div class="chart" v-if="!loading">
      <apexchart type="area" height="500px" width="100%" :options="chartOptions" :series="seriesComputed"></apexchart>
    </div>
    <div class="chart" v-else>
      Loading Chart...
    </div>
  </div>
</template>

<script lang="ts">
import axios from "axios"
import Vue from 'vue'
export default Vue.extend({
  data: ():any => {
    return {
      loading: true as boolean,
      series: [
        {
          name: 'P2P Connections',
          data: [] as number[]
        },
        {
          name: 'Cloud Host Connections',
          data: [] as number[]
        }
      ],
      chartOptions: {
        chart: {
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'datetime',
          categories: [] as any[],
          labels: {
            formatter: function (_value: any, timestamp: string) {
              return new Date(timestamp).toLocaleString("en-GB") // The formatter function overrides format property
            }, 
          }
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
      },
    }
  },
  created() {
    axios.get("https://api.yourcontrols.xyz/stats").then(resoult=>{
      resoult.data.forEach((element: { p2p: number; host: number; timestamp: string }) => {
        this.series[0].data.push(element.p2p)
        this.series[1].data.push(element.host)
        let time = element.timestamp.split(" ", 2)
        this.chartOptions.xaxis.categories.push(time[0]+"T"+time[1]+ "+0200")
      })
      this.loading = false
    })
  },
  methods: {
    getTimezoneOffset: ()=> {
      function z(n:any){return (n<10? '0' : '') + n}
      var offset = new Date().getTimezoneOffset();
      var sign = offset < 0? '+' : '-';
      offset = Math.abs(offset);
      return {h: z(offset/60 | 0), m: z(offset%60)};
    }
  },
  computed: {
    seriesComputed() {
      return this.series
    }
  }
})
</script>

<style lang="scss">
// Small devices (landscape phones, 576px and up)
@media (min-width: 576px) {
  #app {
    .chart {
      width: 100%;
      height: 500px;
      margin: auto;
    }
    .img {
      width: 100%;
      margin: auto;
      text-align: center;
    }
  }
}

// Medium devices (tablets, 768px and up)
@media (min-width: 768px) {
  #app {
    .chart {
      width: 100%;
      height: 150px;
      margin: auto;
    }
    .img {
      img{
        width: 50%;
      }
      width: 100%;
      margin: auto;
      text-align: center;
    }
  }
}

// Large devices (desktops, 992px and up)
@media (min-width: 992px) {
  #app {
    .chart {
      width: 100%;
      height: 500px;
      margin: auto;
    }
    .img {
      width: 100%;
      margin: auto;
      text-align: center;
    }
  }
}

// Extra large devices (large desktops, 1200px and up)
@media (min-width: 1200px) {
  #app {
    .chart {
      width: 1200px;
      height: 500px;
      margin: auto;
    }
    .img {
      width: 1200px;
      margin: auto;
      text-align: center;
    }
  }
}
</style>
