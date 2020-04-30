<template>
    <div class="row">
        <div class="col-12">
            <h1 v-if="permission.length">
                Email Templates
              <router-link :to="{ name: 'admin.send.bulk.emails' }">
                    <button class="btn btn-success" v-for="item in permission" v-if="item.name=='send-bulk-emails'">
                        <fa :icon="'plus'" fixed-width /> Send Bulk Emails
                    </button>
                </router-link>
            </h1>
            <h1 v-if="!permission.length && isUserSuperAdmin">
                Email Templates
                <router-link :to="{ name: 'admin.send.bulk.emails' }">
                    <button class="btn btn-success" >
                        <fa :icon="'plus'" fixed-width />
                        Create Email Template
                    </button>
                </router-link>
            </h1>

            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor molestiae et adipisci minima fugiat possimus. Rem quos animi nisi, quod consequatur nemo accusantium quidem magnam officia veniam, voluptas dicta saepe.</p>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(email, index) in emails.data" :key="index" :userRole="userRole">
                    <td>{{ email.id }}</td>
                    <td>
                        {{ email.name }}
                    </td>
                    <td>
                        {{ email.subject }}
                    </td>

                    <router-link  :to="{ name: 'admin.edit.email.templates', params: { id: email.id } }">
                        <button class="btn btn-sm btn-primary" v-for="item in permission" v-if="item.name=='edit-email-template'" >
                            Edit
                        </button>
                    </router-link>

                </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import $ from 'jquery'
    import axios from 'axios';
    import Swal from 'sweetalert2'

    export default {
        scrollToTop: false,
        metaInfo () {

        },
        data () {
            return {
                userId:'',
                role:[],
                selected: '',
                permission:[],
                role:''

            }
        },
        computed: {
            isUserSuperAdmin () {
                if (this.user.role === 'super-admin') {
                    return true
                } else {
                    return false
                }
            },
            ...mapGetters({
                userRole: 'auth/user',
                emails: 'emails/emails'
            })
        },
        mounted() {
            this.$store.dispatch('emails/fetchEmails');
            this.getRole();
        },
        created(){
            let data=JSON.parse(localStorage.getItem('user_detail'));
            if(data.roles.length){
                this.permission=data.roles[0].permissions.map(item=>({name:item.slug,id:item.id}));
            }
        },
        methods: {

            getRole(){
                axios.get('api/v1/role-management/role').then(resposne=>{
                    this.role=resposne.data.data.map(item=>({text:item.title,value:item.id}))

                }).catch(error=>{
                    console.log(error);
                });
            },

            disableEmail: async function (user) {
                var self = this;
                Swal.fire({
                    type: 'question',
                    title: this.$t('activate_user_title'),
                    text: this.$t('activate_user_text'),
                    reverseButtons: true,
                    confirmButtonText: this.$t('deactivate'),
                    showCancelButton: true,
                    cancelButtonText: this.$t('cancel')
                })
                    .then(async function(e) {
                        if (e.value === true) {
                            self.$store.dispatch('emails/disableEmail', user)
                            Swal.fire({
                                type: 'success',
                                title: 'Disabled!',
                                text: 'User deactivated successfully!',
                            });
                        } else {
                            console.log('cancelled')
                            // swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    })
            },
            enableEmail: async function(user) {
                var self = this;
                Swal.fire({
                    type: 'question',
                    title: this.$t('enable_user_title'),
                    text: this.$t('enable_user_text'),
                    reverseButtons: true,
                    confirmButtonText: this.$t('activate'),
                    showCancelButton: true,
                    cancelButtonText: this.$t('cancel')
                })
                    .then(async function(e) {
                        if (e.value === true) {
                            self.$store.dispatch('emails/enableEmail', user)
                            Swal.fire({
                                type: 'success',
                                title: 'Enabled!',
                                text: 'User account successfully enabled!',
                            });
                        } else {
                            console.log('cancelled')
                        }
                    })
            }
        }
    }
</script>
<style scoped>
    .modal.show .modal-dialog {
        transform: none;
        margin-top: 63px;
    }
</style>
