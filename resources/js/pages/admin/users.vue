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
          <tr v-for="(usr, index) in users" :key="index" :usr="usr">
            <td>{{ usr.id }}</td>
            <td>
              <router-link :to="{ name: 'admin.users' }">
                {{ usr.name }}
              </router-link>
            </td>
            <td>{{ usr.role }}</td>
            <td>{{ usr.email }}</td>
            <td>
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
    return { title: this.$t('admin_users') }
  },
  data () {
    return {
      users: [
        {
          id: 1,
          name: 'Meta',
          email: 'admin@admin.com',
          role: 'super-admin'
        },
        {
          id: 2,
          name: 'User',
          email: 'user@user.com',
          role: 'user'
        },
        {
          id: 3,
          name: 'Writer',
          email: 'writer@user.com',
          role: 'writer'
        },
        {
          id: 4,
          name: 'VIP',
          email: 'vip@user.com',
          role: 'vip'
        }
      ]
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
      user: 'auth/user'
    })
  },
  methods: {

  }
}
</script>
