<template>
  <div class="row px-2">
    <div class="col-md-3 my-4">
      <card :title="$t('admin')" class="settings-card">
        <ul class="nav flex-column nav-pills">
          <li v-for="tab in tabs" :key="tab.route" class="nav-item">
            <router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
              <fa :icon="tab.icon" fixed-width/>
              {{ tab.name }}
            </router-link>
          </li>
        </ul>
      </card>
    </div>

    <div class="col-md-9 my-4">
      <transition name="fade" mode="out-in">
        <router-view/>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'admin',

  computed: {
    tabs () {
      return [
        {
          icon: 'shield-alt',
          name: this.$t('roles'),
          route: 'admin.roles'
        },
        {
          icon: 'user',
          name: this.$t('users'),
          route: 'admin.users'
        },
        {
          icon: 'newspaper',
          name: this.$t('blogs'),
          route: 'admin.blogs'
        },
      ]
	},
	...mapGetters({
		user: 'auth/user'
	}),
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
