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
              Icon Class
            </th>
            <th class="text-center">
              Color Class
            </th>
            <th class="text-center">
              Users
            </th>
            <th class="text-center">
              Permissions
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
              {{ role.icon }}
            </td>
            <td class="text-center align-middle">
              {{ role.color }}
            </td>

            <td class="text-center align-middle">
              <button class="btn btn-sm btn-secondary">
                {{ role.member_count }} Members
              </button>
            </td>

            <td v-if="isUserSuperAdmin" class="text-center align-middle">
              <button class="btn btn-sm btn-secondary">
                {{ role.member_count }} Permissions
              </button>
            </td>
            <td v-else class="text-center align-middle">
              {{ role.permission_count }}
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
    return {
      roles: [
        {
          id: 8,
          title: 'Super Admin',
          slug: 'super-admin',
          icon: 'crown',
          color: 'text-danger',
          description: 'Reserved for Developers',
          permission_count: 52,
          permissions: {},
          member_count: 1,
          members: {}
        },
        {
          id: 7,
          title: 'Admin',
          slug: 'admin',
          icon: 'shield-alt',
          color: 'text-danger',
          description: 'High level administrative User!',
          permission_count: 25,
          permissions: {},
          member_count: 2,
          members: {}
        },
        {
          id: 6,
          title: 'Moderator',
          slug: 'moderator',
          icon: 'star',
          color: 'text-warning',
          description: 'Admin User with minimal permissions!',
          permission_count: 15,
          permissions: {},
          member_count: 2,
          members: {}
        },
        {
          id: 5,
          title: 'Writer',
          slug: 'writer',
          icon: 'newspaper',
          color: 'text-primary',
          description: 'Content Creator & Writer!',
          permission_count: 4,
          permissions: {},
          member_count: 3,
          members: {}
        },
        {
          id: 4,
          title: 'Partner / Sponsor / Advertiser',
          slug: 'partner',
          icon: 'handshake',
          color: 'text-success',
          description: 'Reserved for Partners, Sponsors & Advertisers!',
          permission_count: 5,
          permissions: {},
          member_count: 82,
          members: {}
        },
        {
          id: 3,
          title: 'VIP',
          slug: 'vip',
          icon: 'user-plus',
          color: 'text-success',
          description: 'Special User Role, Reserved for !',
          permission_count: 2,
          permissions: {},
          member_count: 11,
          members: {}
        },
        {
          id: 2,
          title: 'User',
          slug: 'user',
          icon: 'user',
          color: 'text-dark',
          description: 'Default User Role!',
          permission_count: 1,
          permissions: {},
          member_count: 125927,
          members: {}
        },
        {
          id: 1,
          title: 'Banned',
          slug: 'banned',
          icon: 'ban',
          color: 'text-muted',
          description: 'Banned Users...',
          permission_count: 0,
          permissions: {},
          member_count: 1,
          members: {}
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
