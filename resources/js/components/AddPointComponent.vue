<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalpoint">
            Ajouter
        </button>

        <!-- Modal -->
        <div class="modal fade" data-bs-backdrop="static" id="exampleModalpoint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouveau point de livraison</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit="pointStore">
                            <div class="form-group">
                                <label for="name">Nom du point</label>
                                <input type="text" name="name" required class="form-control" id="name" v-model="nom_point">
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea name="desc" required class="form-control" id="desc" rows="4" v-model="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix par point</label>
                                <input type="number" name="prix" required class="form-control" id="prix" v-model="prix">
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <select class="form-select" required aria-label="Default select example" v-model="ville">
                                    <option v-for="ville in Villes" :key="ville.id" v-bind:value="ville.id">{{ ville.nom_ville }}</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-sm-end mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit"  data-bs-dismiss="modal" class="btn btn-primary ml-2">Ajouter</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['Villes'],
        data() {
            return {
                nom_point: '',
                description: '',
                ville: {},
                prix: '',
            }
        },
        methods: {
            pointStore() {
                axios.post('/point', {
                    nom_point: this.nom_point,
                    description: this.description,
                    prix: this.prix,
                    ville: this.ville
                })
                .then(response => this.$emit('Point-added', response))
                .catch(error => console.log(error));
                this.nom_point = '';
                this.description = '';
                this.prix = '';
                this.ville = '';
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
