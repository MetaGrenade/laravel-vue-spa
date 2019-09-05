<template>
    <div class="row">
        <div class="col-12">
            <form @submit.prevent="update" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                <alert-success :form="form" :message="$t('user_updated')" />
                <div class="row">
                    <div class="form-group col-lg-12">
                        <h1>Update User</h1>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="name">Name:</label>
                        <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" class="form-control" id="name" placeholder="Name">
                        <input v-model="form.id" hidden type="text" id="id" class="form-control" >
                        <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="email">Email:</label>
                        <input :disabled="userEmail"  v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="" class="form-control" id="email" placeholder="Email">
                        <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="role">Role:</label>
                        <select v-model="form.role" :class="{ 'is-invalid': form.errors.has('role') }" name="role" class="form-control" id="role">
                            <option value="" disabled>- Select A Role -</option>
                            <option v-for="(roles, index) in users_roles" :key="index" :value="roles.id"  class="text-muted bg-light">{{ roles.title }}</option>
                        </select>
                        <has-error :form="form" field="role"></has-error>
                    </div>

                    <div class="col-12 text-right">
                        <!-- Submit Button -->
                        <v-button :loading="form.busy" type="success">
                            {{ $t('save_create') }}
                        </v-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapState } from 'vuex'
    import { Form, HasError, AlertError } from 'vform'
    import Swal from 'sweetalert2'

    export default {
        scrollToTop: false,
        data () {
            return {
                form: new Form({
                    id: '',
                    name: null,
                    email: null,
                    role: null,
                }),
                userEmail: true,
                users_roles: [],

            }
        },

        computed: {

        },

        created() {
            // Fill the roles data from API or STORE.
            this.getUser()
            this.getUsersRoles()

        },

        methods: {
            getUser: async function() {
                // get user data from store or api ?
                await axios.get('/api/admin/users/' + this.$route.params.id)
                    .then(response => {
                        this.form.keys().forEach(key => {
                            this.form[key] = response.data.user[key]
                        })
                        this.form.role=response.data.user_role.role_id;

                    });
            },

            getUsersRoles: async function() {
                // get blog data from store or api ?
                await axios.get('/api/admin/roles')
                    .then(response => {
                        this.users_roles = response.data
                    });
            },

            async update () {
                // Submit the form via a POST request
                await this.form.patch('/api/admin/users/'+this.$route.params.id)
                    .then((response)=>{
                        console.log(response)
                        // return response.json()
                        if(response.status === 200){
                            Swal.fire({
                                type: 'success',
                                title: 'Updated!',
                                text: 'User Successfully Updated!',
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });

            }
        }
    }
</script>
