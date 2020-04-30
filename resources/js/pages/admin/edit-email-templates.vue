<template>
    <div class="row">
        <div class="col-12">
            <form @submit.prevent="update" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                <alert-success :form="form" :message="$t('user_updated')" />
                <div class="row">
                    <div class="form-group col-lg-12">
                        <h1>Update Email Templates</h1>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="name">Name:</label>
                        <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" class="form-control" id="name" placeholder="Name">
                        <input v-model="form.id" hidden type="text" id="id" class="form-control" >
                        <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="subject">Subject:</label>
                        <input v-model="form.subject" :class="{ 'is-invalid': form.errors.has('subject') }" type="" class="form-control" id="subject" placeholder="Subject">
                        <has-error :form="subject" field="subject"></has-error>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="variables">Variables:</label>
                        <input v-model="form.variables" :class="{ 'is-invalid': form.errors.has('variables') }" type="" class="form-control" id="variables" placeholder="Variables">
                        <has-error :form="variables" field="variables"></has-error>
                    </div>

                    <div class="form-group col-12 col-lg-6">
                        <label for="subject">Slug:</label>
                        <input  :disabled="disableSlug" v-model="form.slug" :class="{ 'is-invalid': form.errors.has('slug') }" type="" class="form-control" id="slug" placeholder="Slug">
                        <has-error :form="slug" field="slug"></has-error>
                    </div>

                    <div class="form-group col-12 col-lg-12">
                        <froala  :tag="'textarea'" :config="config" v-model="form.message">Init text</froala>
                    </div>



                    <div class="col-12 text-right">
                        <!-- Submit Button -->
                        <v-button :loading="form.busy" type="success">
                            {{ $t('save_update') }}
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
                    subject: null,
                    variables: null,
                    slug: null,
                    message: null,
                }),
                disableSlug: true,
                config: {
                    toolbarButtons: ['undo', 'redo' ,  'html', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'insertTable'],
                }
            }
        },

        computed: {

        },

        created() {
            // Fill the roles data from API or STORE.
            this.getEmailsTemplate()
            this.getUsersRoles()

        },

        methods: {
            getEmailsTemplate: async function() {
                await axios.get('/api/v1/emails-templates/edit/' + this.$route.params.id)
                    .then(response => {
                        this.form.keys().forEach(key => {
                            this.form[key] = response.data.data.emailEdited[key]
                        })

                    }).catch(error => {
                        console.log('erro');
                    });
            },

            async update () {
                // Submit the form via a POST request
                await this.form.patch('/api/v1/emails-templates/update/'+this.$route.params.id)
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
