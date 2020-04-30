<template>
  <div class="row">
    <div class="col-12">
      <h1 v-if="permission.length">
          User Management
        <router-link :to="{ name: 'admin.create.users' }">
          <button class="btn btn-success" v-for="item in permission" v-if="item.name=='create-user'">
            <fa :icon="'plus'" fixed-width /> Create User
          </button>
        </router-link>
      </h1>
      <h1 v-if="!permission.length && isUserSuperAdmin">
        User Management
        <router-link :to="{ name: 'admin.create.users' }">
          <button class="btn btn-success" >
            <fa :icon="'plus'" fixed-width />
            Create User
          </button>
        </router-link>
      </h1>

      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor molestiae et adipisci minima fugiat possimus. Rem quos animi nisi, quod consequatur nemo accusantium quidem magnam officia veniam, voluptas dicta saepe.</p>
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users" :key="index" :user="user">
            <td>{{ user.id }}</td>
            <td>
              <router-link :to="{ name: 'admin.users' }">
                {{ user.name }}
              </router-link>
            </td>
            <td v-if="user.roles.length>0">{{ user.roles[0].title }}</td>
            <td v-else>---</td>
            <td>{{ user.email }}</td>
            <td v-if="permission.length">

              <router-link  :to="{ name: 'admin.edit.users', params: { id: user.id } }">
                <button class="btn btn-sm btn-primary" v-for="item in permission" v-if="item.name=='edit-user' && user.role!='super-admin'" >
                  Edit
                </button>
              </router-link>
              <span v-if="user.roles.length>0">
                <button class="btn btn-sm btn-warning" @click="disableUser(user)" v-for="item in permission" v-if="item.name=='disable-user' && user.status == 1 && user.roles[0].slug!='super-admin'">
                  Disable
                </button>
              </span>
              <span v-else>
                <button class="btn btn-sm btn-warning" @click="disableUser(user)" v-for="item in permission" v-if="item.name=='disable-user' && user.status == 1 ">
                  Disable
                </button>
              </span>
              <span v-if="user.roles.length>0">
              <button class="btn btn-sm btn-warning" @click="enableUser(user)" v-for="item in permission" v-if="item.name=='disable-user' && user.status == 0 &&  user.roles[0].slug!='super-admin'">
                Enable
              </button>
              </span>
              <span v-else>
                <button class="btn btn-sm btn-warning" @click="enableUser(user)" v-for="item in permission" v-if="item.name=='disable-user' && user.status == 0">
                  Enable
                </button>
              </span>
              <button class="btn btn-sm btn-danger" @click="deleteUser(user)" v-for="item in permission" v-if="item.name=='delete-user' && user.role!='super-admin'">
                Delete
              </button>
              <button class="btn btn-sm btn-success" @click="assignRole(user.id)" v-for="item in permission" v-if="item.name=='assign-role' && user.role!='super-admin'">
                Assign Role
              </button>
            </td>

          </tr>
        </tbody>
      </table>

      <!--modal start-->

      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">

              <h4 class="modal-title">Assign Role</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

              <b-form-radio-group
                      v-model="selected"
                      :options="role"
                      switches
                      stacked
              ></b-form-radio-group>
            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-primary" @click="userRole" >Submit</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>


      <!--modal end-->
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
		return { title: this.$t('admin_users') }
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
			user: 'auth/user',
			users: 'users/users'
		})
	},
	mounted() {
		this.$store.dispatch('users/fetchUsersAdmin');
      this.getRole();
	},
  created(){
    let data=JSON.parse(localStorage.getItem('user_detail'));
    if(data.roles.length){
      this.permission=data.roles[0].permissions.map(item=>({name:item.slug,id:item.id}));
    }
  },
	methods: {
      userRole(){
        axios.post('api/v1/role-management/assign-role',{user_id:this.userId,role_id:this.selected})
                .then(response=>{
                  $("#myModal").modal('hide');
                  this.$alertify.success('Role Assigned');
                  this.selected=null;
                }).catch(error=>{


          if (error.response.status == 422) {
            this.$alertify.error('Select Role for the user');
          }
        })
      },
	  getRole(){
	    axios.get('api/v1/role-management/role').then(resposne=>{
	      this.role=resposne.data.data.map(item=>({text:item.title,value:item.id}))

        }).catch(error=>{
         console.log(error);
        });
      },
      assignRole(userId){

        this.userId=userId;
        axios.post('api/v1/role-management/get-role-id',{user_id:userId}).then(response=>{
          console.log(response.data.data);
          this.selected=response.data.data[0];
          $("#myModal").modal();
        }).catch(error=>{})

        },
		disableUser: async function (user) {
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
					self.$store.dispatch('users/deactivateUser', user)
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
		deleteUser: async function (user) {
			var self = this;
		  	Swal.fire({
				type: 'question',
				title: this.$t('warning_confirm_title'),
				text: this.$t('warning_confirm_delete_user'),
				reverseButtons: true,
				confirmButtonText: this.$t('delete'),
				showCancelButton: true,
				cancelButtonText: this.$t('cancel')
			})
			.then(async function(e) {
				if (e.value === true) {
					self.$store.dispatch('users/deleteUser', user)
					Swal.fire({
						type: 'success',
						title: 'Deleted!',
						text: 'User account successfully deleted!',
					});
				} else {
					console.log('cancelled')
					// swal("Cancelled", "Your imaginary file is safe :)", "error");
				}
			})
		},
		enableUser: async function(user) {
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
					self.$store.dispatch('users/enableUser', user)
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
