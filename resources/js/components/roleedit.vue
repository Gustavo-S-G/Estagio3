<template>

    <form>
        <div class="modal-body">
            <div class="form-group">
                <input v-model="form.name" type="text" name="name" placeholder="Nome da Função" class="form-control"
                    :class="{'is-invaild': form.errors.has('name')}">
                <has-error :form="form" field="name"></has-error>

            </div>

            <b-form-group label="Assign Permissions">
                <b-form-checkbox v-for="option in permissions" v-model="form.permissions" :key="option.name"
                    :value="option.name" name="flavour-3a">
                    {{ option.name }}
                </b-form-checkbox>
            </b-form-group>


        </div>
        <div class="modal-footer justify-content-between">
            <b-button type="submit" variant="primary" class="btn-lg btn-primary" v-if="!dis" disabled>
                <b-spinner small type="grow"></b-spinner>Editando Função
            </b-button>
            <button type="submit" v-if="dis" @click.prevent="updateRole()" class="btn btn-lg btn-primary"><i
                    class="fas fa-save"></i> Salvar Função</button>
        </div>
    </form>

    <!-- <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar Função</h4>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="updateRole">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" v-model="role.name">
                            </div>
                            <div class="form-group">
                                <label for="guard_name">Guard Name</label>
                                <input type="text" class="form-control" id="guard_name" v-model="role.guard_name">
                            </div>
                            <div class="form-group">
                                <label for="permissions">Permissions</label>
                                <select class="form-control" id="permissions" v-model="role.permissions" multiple>
                                    <option v-for="permission in permissions" :value="permission.id">
                                        {{ permission.name }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
import { Form } from 'vform';
import axios from 'axios';

export default {
    name: 'roleedit',
    data() {
        return {
            form: new Form({
                id: '',
                name: '',
                role: '',
                permissions: [],
            }),
            role: {
                name: '',
                permissions: []
            },
            permissions: [],
            errors: []
        }
    },
    methods: {
        getRole: async function() {
            const response = await axios.get('/roles/update' + this.$route.params.id);
            this.role = response.data.role;
            this.permissions = response.data.permissions;
        },
        getPermissions: async function(){
            axios.get('/getAllPermission')
            .then(response => {
                this.permissions = response.data.permissions;
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo deu errado!',
                })
            });
        },
        updateRole() {
            axios.put('/roles/update' + this.$route.params.id, this.role)
                .then(response => {
                    this.$router.push('/roles')
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                })
        },
        editRole() {
            this.form.put('/roles/update' + this.$route.params.id)
                .then(response => {
                    this.$router.push('/roles')
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                })
        }
    },
    mounted() {
        this.getRole()
        this.getPermissions()
    }
}
</script>
