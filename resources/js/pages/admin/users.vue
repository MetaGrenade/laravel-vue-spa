<template>
	<div class="row">
		<div class="col-12">
			<h1>User Management <button class="btn btn-secondary"><fa :icon="'plus'" fixed-width/> Create User</button></h1>
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
					<tr v-for="(usr, index) in users" :usr="usr" :key="index">
						<td>{{ usr.id }}</td>
						<td><router-link :to="{ name: 'user' }">{{ usr.name }}</router-link></td>
						<td>{{ usr.role }}</td>
						<td>{{ usr.email }}</td>
						<td>
							<button class="btn btn-sm btn-primary">Edit</button> 
							<button class="btn btn-sm btn-warning" v-if="isUserAdmin">Disable</button>
							<button class="btn btn-sm btn-danger" v-if="isUserSuperAdmin">Delete</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
	scrollToTop: false,
	metaInfo () {
		return { title: this.$t('admin_users') }
	},
	data () {
		return {
			users: [
				{
					id: 1,
					name: 'Meta',
					email: 'admin@admin.com',
					role: 'super-admin',
				},
				{
					id: 2,
					name: 'User',
					email: 'user@user.com',
					role: 'user',
				},
				{
					id: 3,
					name: 'Writer',
					email: 'writer@user.com',
					role: 'writer',
				},
				{
					id: 4,
					name: 'VIP',
					email: 'vip@user.com',
					role: 'vip',
				}
			]
		}
	},
	methods: {

	},
	computed: {
		isUserSuperAdmin () {
			if(this.user.role == 'super-admin'){
				return true;
			}
			else {
				return false;
			}
		},
		isUserAdmin () {
			if(this.user.role == 'super-admin' || this.user.role == 'admin' || this.user.role == 'moderator'){
				return true;
			}
			else {
				return false;
			}
		},
		...mapGetters({
			user: 'auth/user'
		})
	}
}
</script>
