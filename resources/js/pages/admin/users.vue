<template>
  <div class="row">
    <div class="col-12">
      <h1>
        User Management <button class="btn btn-success">
          <fa :icon="'plus'" fixed-width /> Create User
        </button>
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
            <td>{{ user.role }}</td>
            <td>{{ user.email }}</td>
            <td>
              <button class="btn btn-sm btn-primary" v-if="user.id !== 1">
                Edit
              </button>
              <button class="btn btn-sm btn-warning" v-if="user.id !== 1">
                Disable
              </button>
              <button class="btn btn-sm btn-danger" v-if="isUserSuperAdmin && user.id !== 1">
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
		return { title: this.$t('admin_users') }
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
			users: 'users/users'
		})
	},
	mounted() {
		this.$store.dispatch('users/fetchUsersAdmin')
	},
	methods: {
		disableUser: async function (user) {
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
					self.$store.dispatch('users/forceDeleteUser', user)
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
				title: this.$t('warning_confirm_title'),
				text: this.$t('warning_confirm_enable_user'),
				reverseButtons: true,
				confirmButtonText: this.$t('ok'),
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
