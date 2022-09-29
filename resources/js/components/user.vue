<template>
    <div class="p-0">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-users mr-1"></i>
                    Usuários
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item mr-1">
                            <button class="btn btn-sm btn-primary" @click="createMode"> <i class="fas fa-plus-circle"></i>
                                Adicionar Novo Usuário
                            </button>
                        </li>
                        <li class="nav-item">
                            <div class="input-group mt-0 input-group-sm" style="width: 350px;">
                                <input type="text" name="table_search" v-model="searchWord" class="form-control float-right"
                                    placeholder="Pesquisar por nome, email">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default" @click="search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body table-responsible p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Função</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                            <th>Data Criado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.role }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" @click="viewUser(user)"> <i class="fas fa-eye"></i> Visualizar </button>
                                <button class="btn btn-sm btn-warning" @click="editUser(user)"> <i class="fas fa-edit"></i> Editar </button>
                                <button class="btn btn-sm btn-danger" @click="deleteUser(user)"> <i class="fas fa-trash"></i> Deletar </button>
                            </td>
                            <td>
                                {{ user.created_at | date }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
            <loading :loading="loading"></loading>
        </div>

        <!-- Modal View User -->
        <div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Nome:</b> {{ user.name }}</p>
                                <p><b>Email:</b> {{ user.email }}</p>
                                <p><b>Ultima Atualização:</b> {{ user.updated_at | date }}</p>
                                <p><b>Data Criado:</b> {{ user.created_at | date }}</p>
                            </div>

                            <div class="col-md-6">
                                <img style="width: 100%" :src="img" class="img-circle">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create User -->
        <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel" v-show="!editMode">Criar Usuário</h5>
                        <h5 class="modal-title" id="createUserModalLabel" v-show="editMode">Editar Usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="!editMode ? createUser() : updateUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label> Nome </label>
                                <input v-model="form.name" type="text" name="name" placeholder="Nome"
                                    class="form-control" :class="{'is-invaild': form.errors.has('name')}">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <label> Email </label>
                                <input v-model="form.email" type="text" name="email" placeholder="Email"
                                    class="form-control" :class="{'is-invaild': form.errors.has('email')}">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <label> Escolha uma Função </label>
                                <b-form-select v-model="form.role" :options="roles" text-field="name" value-field="id">
                                </b-form-select>
                                <has-error :form="form" field="role"></has-error>
                            </div>

                            <div class="form-group">
                                <label> Senha </label>
                                <input v-model="form.password" type="password" name="password" placeholder="Senha"
                                    class="form-control" :class="{'is-invaild': form.errors.has('password')}">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                            <b-form-group label="Atribur Permissões">
                                <b-form-checkbox v-for="option in permissions" v-model="form.permissions"
                                    :key="option.name" :value="option.name" name="flavour-3a">
                                    {{ option.name }}
                                </b-form-checkbox>
                            </b-form-group>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Fechar</button>
                            <b-button variant="primary" v-if="!load" class="btn-lg" disabled>
                                <b-spinner small type="grow"></b-spinner>
                                {{  action }}
                            </b-button>
                            <button type="submit" v-if="load" v-show="!editMode" class="btn btn-lg btn-primary">Salvar Usuário</button>
                            <button type="submit" v-if="load" v-show="editMode" class="btn btn-lg btn-success">Editar Usuário</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from 'vform';
import axios from 'axios';

export default {
    data() {
        return {
            action: '',
            searchWord: '',
            loading: false,
            load: true,
            editMode: false,
            img: 'http://127.0.0.1:8000/imagens/avatar.jpg',
            user: {},
            users: [],
            roles: [],
            permissions: [],
            form: new Form({
                id: '',
                name: '',
                email: '',
                role: '',
                password: '',
                permissions: [],
            }),
        }
    },
    methods: {
        search(){
            this.loading = true;
            axios.get('/search/user?s='+this.searchWord).then((response) =>{
                this.loading = false;
                this.users = response.data.users
            }).catch(() =>{
                this.loading = false;
                toast.fire({
                    icon: 'error',
                    title: "A pesquisa falhou"
                })
            })
        },
        getUsers: async function () {
            this.loading = true;
            await axios.get('/getAllUsers').then((response) => {
                this.loading = false;
                this.users = response.data.users
            }).catch(() => {
                this.loading = false;
                this.$toastr.e("Cannot load users", "Error");
            })
        },
        getRoles: async function () {
            await axios.get('/getAllRoles').then((response) => {
                this.roles = response.data.roles
            }).catch(() => {
                this.loading = false;
                this.$toastr.e("Cannot load roles", "Error");
            })
        },
        getPermissions: async function () {
            await axios.get('/getAllPermissions').then((response) => {
                this.permissions = response.data.permissions
            }).catch(() => {
                this.loading = false;
                this.$toastr.e("Cannot load permissions", "Error");
            })
        },
        createUser: async function () {
            this.action = 'Criando Usuário ...';
            this.load = false;
            await this.form.post('/account/create')
                .then(() => {
                    this.load = true;
                    this.$toastr.s("usuário criar com sucesso", "Criado");
                    Fire.$emit("loadUser");
                    $("#createUser").modal("hide");
                    this.form.reset();
                })
                .catch(() => {
                    this.load = true;
                    this.$toastr.e("Não foi possível criar o usuário", "Error");
                })
        },
        updateUser: async function () {
            this.action = 'Editando Usuário ...';
            this.load = false;
            await this.form.put("/account/update/" +this.form.id)
                .then(() => {
                    this.load = true;
                    this.$toastr.s("usuário editado com sucesso", "Editado");
                    Fire.$emit("loadUser");
                    $("#createUser").modal("hide");
                    this.form.reset();
                })
                .catch(() => {
                    this.load = true;
                    this.$toastr.e("Não foi possível editar o usuário", "Error");
                })
        },
        viewUser: async function (user) {
            $("#viewUser").modal("show");
            this.img = 'http://127.0.0.1:8000/imagens/'+user.photo;
            this.user = user;

        },
        editUser(user){
            this.editMode = true;
            this.form.reset();
            this.form.fill(user);
            this.form.role = user.roles[0].id;
            this.form.permissions = user.userPermissions
            $('#createUser').modal('show');
        },
        createMode(){
            this.editMode = false;
            $('#createUser').modal('show');
        },
        deleteUser(user){
            swal.fire({
                title: 'Tem certeza?',
                text: user.name + " será deletado permanentemente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, delete isso!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.value) {
                    axios.delete('/delete/user/'+user.id).then(() =>{
                        toast.fire({
                            icon: 'success',
                            title: user.name +" foi excluído com sucesso"
                        })
                        Fire.$emit("loadUser");
                    }).catch(() =>{
                        toast.fire({
                            icon: 'error',
                            title: user.name +" não foi possível remover, tente novamente mais tarde"
                        })
                    })
                }
            })
        },
    },
    created() {
        this.getUsers();
        this.getRoles();
        this.getPermissions();
        Fire.$on('loadUser', () => {
            this.getUsers();
        });
    }
}
</script>
