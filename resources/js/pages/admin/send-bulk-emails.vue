<template>
    <div class="row">
        <div class="col-12 text-right">
            <button v-if="bulkOrSystemEmail" v-on:click="testBulkEmail"  :loading="form.busy" class="btn btn-success ">
                {{ $t('send_test_bulk_emails') }}
            </button>
            <button v-else v-on:click="testBulkEmail"  :loading="form.busy" class="btn btn-success ">
                {{ $t('send_bulk_emails') }}
            </button>
        </div>


        <div v-if="bulkOrSystemEmail" class="col-12">
            <form @submit.prevent="sendEmails" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                <alert-success :form="form" :message="$t('bulk_emails_sent')" />
                <div class="row">
                    <div class="form-group col-lg-12">
                        <h1>Send Bulk Emails
                        </h1>
                    </div>
                    <div class="form-group col-12 col-lg-12">
                        <label for="role">Email Template:</label>
                        <select v-model="form.template" :class="{ 'is-invalid': form.errors.has('template') }" name="template" class="form-control" id="template">
                            <option value="" disabled>- Select Email Template -</option>
                            <option v-for="(email, index) in emails.emails.data" :key="index" :value="email.id"  v-if="email.type=='bulk_mail'" class="text-muted bg-light">{{ email.name }}</option>
                        </select>
                        <has-error :form="form" field="template"></has-error>
                    </div>


                    <div class="form-group col-12 col-lg-12">
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
                            {{ $t('send_bulk_emails') }}
                        </v-button>
                    </div>
                </div>
            </form>
        </div>


        <div v-else class="col-12">
            <form @submit.prevent="sendTestEmails" @keydown="testForm.onKeydown($event)" enctype="multipart/form-data">
                <alert-success :form="form" :message="$t('bulk_emails_sent')" />
                <div class="row">
                    <div class="form-group col-lg-12">
                        <h1>Send A Test Email
                        </h1>
                    </div>

                    <div class="form-group col-12 col-lg-12">
                        <label for="role">Email Template:</label>
                        <select v-model="testForm.template" :class="{ 'is-invalid': testForm.errors.has('template') }" name="template" class="form-control" id="template">
                            <option value="" disabled>- Select Email Template -</option>
                            <option v-for="(email, index) in emails.emails.data" :key="index" :value="email.id"  v-if="email.type=='bulk_mail'" class="text-muted bg-light">{{ email.name }}</option>
                        </select>
                        <has-error :form="form" field="template"></has-error>
                    </div>

                    <div class="form-group col-12 col-lg-12">
                        <label for="role">Select an Email:</label>
                        <select v-model="testForm.email" :class="{ 'is-invalid': testForm.errors.has('email') }" name="email" class="form-control" id="email">
                            <option value="" disabled>- Select Email Template -</option>
                            <option v-for="(user, index) in users.users" :key="index" :value="user.email"  v-if="user.role=='super-admin' || user.role=='admin' || user.role=='moderator'" class="text-muted bg-light">{{ user.email }}</option>
                        </select>
                        <has-error :form="testForm" field="template"></has-error>
                    </div>

                    <div class="col-12 text-right">
                        <!-- Submit Button -->
                        <v-button :loading="testForm.busy" type="success">
                            {{ $t('send_test_bulk_emails') }}
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
                    template: null,
                    role: null,
                }),

                testForm: new Form({
                    template: null,
                    email: null,
                }),

                users_roles: [],
                bulkOrSystemEmail: true,

            }
        },

        computed: mapState([
            'emails',
            'users'
        ]),

        mounted() {
            this.$store.dispatch('emails/fetchEmails');
            this.$store.dispatch('users/fetchUsersAdmin');
        },

        created() {
            // Fill the roles data from API or STORE.
            this.getUsersRoles()
        },

        methods: {

            testBulkEmail(){
                //alert('wow');
                if(this.bulkOrSystemEmail == true)
                {
                    this.bulkOrSystemEmail = false;
                }else {
                    this.bulkOrSystemEmail = true;
                }

            },


            getUsersRoles: async function() {
                // get roles data from api ?
                await axios.get('/api/admin/roles')
                    .then(response => {
                        this.users_roles = response.data
                    });
            },

            async sendEmails () {
                // Submit the form via a POST request
                await this.form.post('/api/v1/emails-templates/send-bulk-emails')
                    .then((response)=>{
                        console.log(response)
                        // return response.json()
                        if(response.status === 201){
                            Swal.fire({
                                type: 'success',
                                title: 'Emails Sent!',
                                text: 'Emails Successfully Sent!',
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });

            },

            async sendTestEmails () {
               // alert('wow');
                // Submit the form via a POST request
                await this.testForm.post('/api/v1/emails-templates/send-test-emails')
                    .then((response)=>{
                        console.log(response)
                        // return response.json()
                        if(response.status === 201){
                            Swal.fire({
                                type: 'success',
                                title: 'Emails Sent!',
                                text: 'Emails Successfully Sent!',
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },



        }
    }
</script>
