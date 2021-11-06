<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bienvenue-header">Liste des villes</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <addville class="mb-3" @Ville-added="refresh"></addville>
                        <div class="form-row">
                            <div class="col-row">
                                <input type="text" class="form-control" @keyup="searchVille" v-model="q" placeholder="Rechercher une ville...">
                            </div>
                        </div>
                        </div>
                        
                        <table class="table table-primary .table-hover table-responsive-md  ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col" class="d-flex justify-content-sm-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ville, index) in villes.data" :key="ville.id">
                                    <th scope="row">{{ index + 1 + ((villes.current_page - 1) * 4) }}</th>
                                    <td>{{ ville.nom_ville }}</td>
                                    <td class="d-flex justify-content-sm-end">
                                        <button type="button" class="btn btn-warning mr-2" data-bs-toggle="modal" data-bs-target="#EditModal" @click="getVille(ville.id)">
                                        Editer
                                         </button>
                                         <button type="button" class="btn btn-danger" @click="deleteVille(ville.id)">Supprimer</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <editville v-bind:villeToEdit = "villetoedit" @ville-updated="refresh"></editville>
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
import EditVilleComponent from './EditVilleComponent.vue';
    export default {
  components: { AddVilleComponent, EditVilleComponent },

        data() {
            return {
                villes: {},
                villetoedit: '',
                q: '',
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
            getVille(id) {
                axios.get('/ville/edit/' + id)
                    .then(response => this.villetoedit = response.data)
                    .catch(error => console.log(error));
            },
            searchVille(){
                if (this.q.length > 0) {
                    axios.get('/ville/' + this.q)
                        .then(response => this.villes = response.data)
                        .catch(error => console.log(error));
                } else {
                    axios.get('/ville')
                        .then(response => this.villes = response.data)
                        .catch(error => console.log(error));
                }
            },
            refresh(villes){
                this.villes = villes.data;
            },
            deleteVille(id) {
                Swal.fire({
                    title: 'Etes vous sûre?',
                    text: "Cette action est irréversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete('/ville/' + id)
                            .then(response => this.villes = response.data)
                            .catch(error => console.log(error));
                        Swal.fire(
                        'Effectué!',
                        'La ville a été supprimée.',
                        'success'
                        );
                    }
                });
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        
        
    }
</script>
