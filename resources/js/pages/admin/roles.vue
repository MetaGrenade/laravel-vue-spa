<template>
  <div class="row">
    <div class="col-12">
      <h1 v-if="userpermissions.length">
        Create Role <router-link :to="{ name: 'admin.createRoles' }">
        <button v-for="item in userpermissions" v-if="item.name=='create-role'" class="btn btn-success"><fa :icon="'plus'" fixed-width /> Create Role</button></router-link>
      </h1>

      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor molestiae et adipisci minima fugiat possimus. Rem quos animi nisi, quod consequatur nemo accusantium quidem magnam officia veniam, voluptas dicta saepe.</p>
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th class="text-center">
              ID
            </th>
            <th>Title</th>
            <th class="text-center">
              Access Level
            </th>
            <th class="text-center">
              Color (Icon)
            </th>
            <th class="text-center">
              Users / Permissions
            </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(role, index) in roles" :key="index" :role="role">
            <td class="text-center align-middle">
              {{ role.id }}
            </td>
            <td class="align-middle">
              <router-link :to="{ name: 'admin.roles' }" :class="role.color">
                <fa :icon="role.icon" fixed-width /> {{ role.title }}
              </router-link>
              <div>
                <small class="text-muted">{{ role.description }}</small>
              </div>
            </td>

			<td class="text-center align-middle">
              {{ role.access_level }}
            </td>
            <td class="text-center align-middle">
              {{ role.color }} ({{ role.icon }})
            </td>

            <td class="text-center align-middle">
              <button class="btn btn-sm btn-secondary">
                {{ role.member_count }} Members
              </button>
			  <button class="btn btn-sm btn-secondary" v-if="isUserSuperAdmin">
                {{ role.permission_count }} Permissions
              </button>
            </td>

            <td class="align-middle" v-if="userpermissions.length">

              <div class="btn-group">
              <button class="btn btn-sm btn-primary" v-for="item in userpermissions" v-if="item.name=='edit-role'">
                Edit
              </button>
              <button class="btn btn-sm btn-warning" v-for="item in userpermissions" v-if="item.name=='disable-role'">
                Disable
              </button>
              <button  class="btn btn-sm btn-danger" v-for="item in userpermissions" v-if="item.name=='delete-role' ">
                Delete
              </button>
                <button  class="btn btn-sm btn-primary" @click="assignPermission(role.id)" v-for="item in userpermissions" v-if="item.name=='assign-permission'">
                  Assign Permission
                </button>
              </div>
            </td>
            <td class="align-middle" v-if="!userpermissions.length && isUserSuperAdmin">
              <div class="btn-group">
                <button class="btn btn-sm btn-primary">
                  Edit
                </button>
                <button class="btn btn-sm btn-warning">
                  Disable
                </button>
                <button  class="btn btn-sm btn-danger">
                  Delete
                </button>
                <button  class="btn btn-sm btn-primary" @click="assignPermission(role.id)">
                  Assign Permission
                </button>
              </div>
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

              <h4 class="modal-title">Assign Permissions</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

              <b-form-checkbox-group
                      v-model="selected"
                      :options="permission"
                      switches
                      stacked
              ></b-form-checkbox-group>
              </b-form-group>
            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-primary" @click="submitPermission" >Submit</button>
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
import { mapGetters } from 'vuex';
import $ from 'jquery'
import axios from 'axios';
export default {
	scrollToTop: false,

	metaInfo () {
		return { title: this.$t('admin_roles') }
	},

  	data () {
    	return {
          status: 'not_accepted',
          selected:[],
          permission:[],
          roleId:'',
          userpermissions:[],
          errors:[]
        }
	},
  created(){
	  this.getPermission();
    let data=JSON.parse(localStorage.getItem('user_detail'));
    if(data.roles.length){
      this.userpermissions=data.roles[0].permissions.map(item=>({name:item.slug,id:item.id}));
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
			roles: 'roles/roles'
		})
	},
	mounted() {
		this.$store.dispatch('roles/fetchRoles')
	},
	methods: {
      getPermission(){

        axios.get('api/v1/permission-management/permission')
                .then(response=>{
                 this.permission=response.data.data.map(item=>({text:item.title,value:item.id}));
                }).catch(error=>{});
      },
      submitPermission(){
        axios.post('/api/v1/permission-management/assign-permission',{
          role_id:this.roleId,
          permission_id:this.selected
        })
                .then(response=>{

                  $("#myModal").modal('hide');
                  this.$alertify.success('permission assigned');
                })
                .catch(error=>{
                  if(error.response.status==422){
                    this.$alertify.error('Please select at least one permission form rule');
                  }

                })
      },
		disableRole: async function (role) {
			var self = this;
		  	Swal.fire({
				type: 'question',
				title: this.$t('warning_confirm_title'),
				text: this.$t('warning_confirm_delete_role'),
				reverseButtons: true,
				confirmButtonText: this.$t('delete'),
				showCancelButton: true,
				cancelButtonText: this.$t('cancel')
			})
			.then(async function(e) {
				if (e.value === true) {
					self.$store.dispatch('roles/deleteRole', role)
					Swal.fire({
						type: 'success',
						title: 'Deleted!',
						text: 'Role successfully deleted!',
					});
				} else {
					console.log('cancelled')
					// swal("Cancelled", "Your imaginary file is safe :)", "error");
				}
			})
		},
      assignPermission(roleId){
        this.roleId=roleId;
       axios.post('api/v1/permission-management/get-permissions-id',{role_id:roleId})
               .then(response=>{
                 this.selected=response.data.data;
                 $("#myModal").modal();
               })
               .catch()
		//$("#myModal").modal();
      },
		enableRole: async function(role) {
			var self = this;
		  	Swal.fire({
				type: 'question',
				title: this.$t('warning_confirm_title'),
				text: this.$t('warning_confirm_enable_role'),
				reverseButtons: true,
				confirmButtonText: this.$t('ok'),
				showCancelButton: true,
				cancelButtonText: this.$t('cancel')
			})
			.then(async function(e) {
				if (e.value === true) {
					self.$store.dispatch('roles/enableRole', role)
					Swal.fire({
						type: 'success',
						title: 'Enabled!',
						text: 'Role successfully enabled!',
					});
				} else {
					console.log('cancelled')
				}
			})
	  	},
		deleteRole: async function (role) {
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
					self.$store.dispatch('roles/forceDeleteRole', role)
					Swal.fire({
						type: 'success',
						title: 'Deleted!',
						text: 'Role successfully deleted!',
					});
				} else {
					console.log('cancelled')
					// swal("Cancelled", "Your imaginary file is safe :)", "error");
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
