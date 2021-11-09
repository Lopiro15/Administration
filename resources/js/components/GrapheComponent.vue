<script>
  import { Bar } from 'vue-chartjs'

  export default {
    extends: Bar,
    props: {
    chartdata: {
      type: Object,
      default: null
    },
    options: {
      type: Object,
      default: null
    }
  },

    mounted () {
      try {
        this.renderChart(this.chartdata, this.options)
      } catch (error) {
        console.log(error)
      }
      
    }
  }
</script>
