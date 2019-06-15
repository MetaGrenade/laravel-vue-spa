<template>
  <div class="row">
    <div class="col-12">
      <h1>
        Roles & Permissions <button class="btn btn-success">
          <fa :icon="'plus'" fixed-width /> Create Role
        </button>
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

            <td class="align-middle">
              <button class="btn btn-sm btn-primary">
                Edit
              </button>
              <button class="btn btn-sm btn-warning">
                Disable
              </button>
              <button v-if="isUserSuperAdmin" class="btn btn-sm btn-danger">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
	scrollToTop: false,

	metaInfo () {
		return { title: this.$t('admin_roles') }
	},

  	data () {
    	return {}
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
