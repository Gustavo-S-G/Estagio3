<template>
    <form>
        <div class="modal-body">
            <div class="form-group">
                <input v-model="form.name" type="text" name="name" placeholder="Nome da Função"
                    class="form-control" :class="{'is-invaild': form.errors.has('name')}">
                <has-error :form="form" field="name"></has-error>

            </div>

            <b-form-group label="Assign Permissions">
                <b-form-checkbox
                    v-for="option in permissions"
                    v-model="form.permissions"
                    :key="option.name"
                    :value="option.name"
                    name="flavour-3a"
                >
                    {{ option.name }}
                </b-form-checkbox>
            </b-form-group>


        </div>
        <div class="modal-footer justify-content-between">
            <b-button type="submit" variant="primary" class="btn-lg btn-primary" v-if="!dis" disabled><b-spinner small type="grow"></b-spinner>Criando Função</b-button>
            <button type="submit"  v-if="dis" @click.prevent="createRole()" class="btn btn-lg btn-primary"><i class="fas fa-save"></i> Salvar Função</button>
        </div>
    </form>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';
import { Form } from 'vform';

export default {
    name: 'role',
    data() {
        return {
            dis: true,
            permissions: [],
            form : new Form({
                name: '',
                permissions: []
            })
        }
    },
    methods: {
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
        createRole(){
            this.dis = false;
            this.form.post("/postRole").then(()=>{
                Swal.fire({
                    icon: 'success',
                    title: 'Role Created',
                    text: 'Função criada com sucesso!',
                })
                window.location = "/role";
            }).catch(()=>{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo deu errado!',
                });
            });
            this.dis=true;
        }
    },
    created() {
        this.getPermissions();
    }
}
</script>
