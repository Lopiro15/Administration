<template>
    <div>
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Modifier la ville</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit="update">
                        <div class="form-group">
                            <label for="name">Nom de la ville</label>
                            <textarea name="name" class="form-control" id="name" rows="4" v-model="villeToEdit.nom_ville"></textarea>
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
        props: ['villeToEdit'],
        methods: {
            update() {
                axios.patch('/ville/edit/' + this.villeToEdit.id, {
                    nom_ville: this.villeToEdit.nom_ville
                })
                .then(response => this.$emit('ville-updated', response))
                .catch(error => console.log(error));
            }
        }
    }
</script>