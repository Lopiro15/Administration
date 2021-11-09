<template>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-5 p-4 rounded shadow-lg border-bottom border-primary border-5 m-3 d-flex justify-content-between" style="background-color: rgba(52, 144, 220, 0.3) !important;">
                <div class="rounded-circle bg-primary p-2"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: white;transform: ;msFilter:;"><path d="M19.15 8a2 2 0 0 0-1.72-1H15V5a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 1 1.73 3.49 3.49 0 0 0 7 .27h3.1a3.48 3.48 0 0 0 6.9 0 2 2 0 0 0 2-2v-3a1.07 1.07 0 0 0-.14-.52zM15 9h2.43l1.8 3H15zM6.5 19A1.5 1.5 0 1 1 8 17.5 1.5 1.5 0 0 1 6.5 19zm10 0a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z"></path></svg></div>
                <div class=" align-content-center">
                    <h6>Points de Livraisons</h6>
                    <h2 class="text-center">{{ donnees.total[1] }}</h2>
                </div>
            </div>
            <div class="col-md-5 p-4 rounded shadow-lg bg-gradient border-bottom border-success border-5 m-3 d-flex justify-content-between" style="background-color: rgba(56, 193, 113, 0.3) !important;">
                <div class="rounded-circle bg-success p-2"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: white;transform: ;msFilter:;"><path d="M21 6h-4V3a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7H3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1zM6 18H4v-2h2v2zm0-4H4v-2h2v2zm5 4H9v-2h2v2zm0-4H9v-2h2v2zm0-4H9V8h2v2zm0-4H9V4h2v2zm4 12h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V8h2v2zm0-4h-2V4h2v2zm5 12h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V8h2v2z"></path></svg></div>
                <div>
                    <h6 >Villes</h6>
                    <h2 class="text-center">{{ donnees.total[0] }}</h2>
                </div>
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-md-10  border shadow-lg rounded">
                <graphe :chartdata="donnees.chartdata" :options="donnees.options"></graphe>
            </div>
        </div>
    </div>
</template>

<script>
import GrapheComponent from './GrapheComponent.vue';
    export default {
  components: { GrapheComponent },
        data () {
            return {
                donnees: {}
            }
        },
        created () {
            axios.get('/Home')
                .then(response => this.donnees = response.data)
                .catch(error => console.log(error));
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
