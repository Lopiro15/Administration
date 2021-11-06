<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bienvenue-header">Liste des points de livraison</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <addpoint class="mb-3" v-bind:Villes="villes" @Point-added="refresh"></addpoint>
                            <div class="col-row">
                                <input type="text" class="form-control" @keyup="searchPoint" v-model="q" placeholder="Rechercher...">
                            </div>
                            <div class="col-row">
                                <select class="form-select" required aria-label="Default select example" v-model="v" @change="searchPoint">
                                    <option v-for="ville in villes" :key="ville.id" v-bind:value="ville.id">{{ ville.nom_ville }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <table class="table table-primary .table-hover table-responsive-md  ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col" class="d-flex justify-content-sm-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(point, index) in points.data" :key="point.id">
                                    <th scope="row">{{ tot?(index + 1 + ((points.current_page - 1) * 4)) : (index + 1) }}</th>
                                    <td>{{ point.nom_point }}</td>
                                    <td>{{ point.description }}</td>
                                    <td>{{ point.prix }}</td>
                                    <td class="d-flex justify-content-sm-end">
                                        <button type="button" class="btn btn-warning mr-2" data-bs-toggle="modal" data-bs-target="#EditModalpoint" @click="getPoint(point.id)">
                                            Editer
                                        </button>
                                         <button type="button" class="btn btn-danger" @click="deletePoint(point.id)">Supprimer</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <editpoint v-bind:pointToEdit = "pointtoedit" v-bind:Villes="villes" @point-updated="refresh"></editpoint>
                    </div>
                    <div class="card-footer d-flex justify-content-sm-between">
                        <pagination :data="points" @pagination-change-page="getResults"></pagination>
                        <h4>Total: <span class="badge bg-primary">{{ tot? points.total : points.data.length }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AddPointComponent from './AddPointComponent.vue';
import EditPointComponent from './EditPointComponent.vue';
    export default {
  components: { AddPointComponent, EditPointComponent },

        data() {
            return {
                points: {},
                pointtoedit: '',
                villes: {},
                q: '',
                v: 1,
                tot: true,
            }
        },

        created(){
            axios.get('/points')
                .then(response => this.villes = response.data)
                .catch(error => console.log(error));
            axios.get('/point/' + this.v)
                .then(response => this.points = response.data)
                .catch(error => console.log(error));
        },
        methods: {
           getResults(page = 1) {
            axios.get('/point?page=' + page)
                .then(response => {
                    this.points = response.data;
                });
            },
            getPoint(id) {
                axios.get('/point/edit/' + id)
                    .then(response => this.pointtoedit = response.data)
                    .catch(error => console.log(error));
            },
            searchPoint(){
                if (this.q.length > 0) {
                    axios.get('/point/' + this.v + '/' + this.q)
                        .then(response => this.points = response.data)
                        .catch(error => console.log(error));
                    this.tot = false;
                } else {
                    axios.get('/point/' + this.v)
                        .then(response => this.points = response.data)
                        .catch(error => console.log(error));
                    this.tot = true;
                }
            },
            refresh(points){
                this.points = points.data;
            },
            deletePoint(id) {
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
                        axios.delete('/point/' + id)
                            .then(response => this.points = response.data)
                            .catch(error => console.log(error));
                        Swal.fire(
                        'Effectué!',
                        'Le point de livarison a été supprimée.',
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
