<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter une ville
        </button>

        <!-- Modal -->
        <div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouvelle ville</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Nom de la ville</label>
                                <textarea name="name" required class="form-control" id="name" rows="4" v-model="nom_ville"></textarea>
                            </div>
                        </form>
                        <div class="d-flex justify-content-sm-end mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="button" @click="villeStore" data-bs-dismiss="modal" class="btn btn-primary ml-2">Ajouter</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                nom_ville: ''
            }
        },
        methods: {
            villeStore() {
                axios.post('/ville', {
                    nom_ville: this.nom_ville,
                })
                .then(response => this.$emit('Ville-added', response))
                .catch(error => console.log(error));
                this.nom_ville = '';
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
