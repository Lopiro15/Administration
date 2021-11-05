<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bienvenue-header">Liste des villes</div>

                    <div class="card-body">
                        <addville class="mb-3" @Ville-added="refresh"></addville>
                        <table class="table table-responsive-md table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ville, index) in villes.data" :key="ville.id">
                                    <th scope="row">{{ index + 1 + ((villes.current_page - 1) * 4) }}</th>
                                    <td>{{ ville.nom_ville }}</td>
                                    <td>Otto</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-sm-between">
                        <pagination :data="villes" @pagination-change-page="getResults"></pagination>
                        <h4>Total: <span class="badge bg-primary">{{ villes.total }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AddVilleComponent from './AddVilleComponent.vue';
    export default {
  components: { AddVilleComponent },

        data() {
            return {
                villes: {},
            }
        },

        created(){
            axios.get('/ville')
                .then(response => this.villes = response.data)
                .catch(error => console.log(error));
        },
        methods: {
           getResults(page = 1) {
            axios.get('/ville?page=' + page)
                .then(response => {
                    this.villes = response.data;
                });
            },
            refresh(villes){
                this.villes = villes.data;
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        
        
    }
</script>
