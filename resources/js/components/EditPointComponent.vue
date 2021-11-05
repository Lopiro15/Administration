<template>
    <div>
        <div class="modal fade" id="EditModalpoint" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Modifier le point de livraison</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit="update">
                        <div class="form-group">
                                <label for="name">Nom du point</label>
                                <input type="text" name="name" required class="form-control" id="name" v-model="pointToEdit.nom_point">
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea name="desc" required class="form-control" id="desc" rows="4" v-model="pointToEdit.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix par point</label>
                                <input type="number" name="prix" required class="form-control" id="prix" v-model="pointToEdit.prix">
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <select class="form-select" aria-label="Default select example" v-model="pointToEdit.ville">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        <div class="d-flex justify-content-sm-end mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit"  data-bs-dismiss="modal" class="btn btn-primary ml-2">Enregistrer</button>
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
        props: ['pointToEdit'],
        methods: {
            update() {
                axios.patch('/point/edit/' + this.pointToEdit.id, {
                    nom_point: this.pointToEdit.nom_point,
                    description: this.pointToEdit.description,
                    prix: this.pointToEdit.prix,
                    ville: this.pointToEdit.ville
                })
                .then(response => this.$emit('point-updated', response))
                .catch(error => console.log(error));
            }
        }
    }
</script>