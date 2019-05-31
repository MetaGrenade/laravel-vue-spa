<template>
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid px-0">
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
        {{ appName }}
      </router-link>

      <button class="navbar-toggler" type="button" data-toggle="offcanvas" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" 
        v-on:click="offcanvas" 
        v-bind:class="{ 'osc-active': isOffcanvas }"
      >
        <span class="navbar-toggler-icon" />
      </button>
      
      <div id="navbarToggler" class="offcanvas-collapse navbar-collapse" v-bind:class="{ open: isOffcanvas }">
        <ul class="navbar-nav mr-auto">
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li> -->
          <div v-on:click="offcanvas">
            <router-link :to="{ name: 'blog' }" tag="li">
              <a class="nav-link" href="#">
                <fa icon="newspaper" fixed-width/>
                {{ $t('blog') }}
              </a>
            </router-link>
          </div>
          <locale-dropdown/>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="dropdown-divider"/>
          <!-- Authenticated -->
          <div v-on:click="offcanvas">
            <router-link :to="{ name: 'admin' }" tag="li" v-if="isUserAdmin">
              <a class="nav-link text-danger" href="#">
                <fa icon="shield-alt" fixed-width/>
                {{ $t('admin') }}
              </a>
            </router-link>
          </div>
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <div v-on:click="offcanvas">
                <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                  <fa icon="cog" fixed-width/>
                  {{ $t('settings') }}
                </router-link>
              </div>

              <div class="dropdown-divider"/>
              <div v-on:click="offcanvas">
                <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                  <fa icon="sign-out-alt" fixed-width/>
                  {{ $t('logout') }}
                </a>
              </div>
            </div>
          </li>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item" v-on:click="offcanvas">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
            <li class="nav-item" v-on:click="offcanvas">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName,
    isOffcanvas : true,
  }),

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
	},

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },
    offcanvas: function() {
      console.log('FK')
      if(this.isOffcanvas === false){
        this.isOffcanvas = true
      }
      else {
        this.isOffcanvas = false
      }
      // some code to filter users
    }
  }
}
</script>

<style lang="scss" scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}

html,
body {
  overflow-x: hidden; /* Prevent scroll on narrow devices */
}

body {
  padding-top: 56px;
}

.navbar {
  z-index: 9999;
  max-height: 56px;
}

.navbar-toggler {
  outline: none;
}

.osc-active {
  background-color: rgba(255, 255, 255, .1) !important;
  border-color: #ffc107 !important; /* border-primary */
  /* #ffc107 warning */
  /* #007bff primary */
}

.navbar-brand {
  transform: translateX(-50%);
  left: 50%;
  position: absolute;
  &:hover{
    color: lightskyblue;
  }
}

@media (max-width: 991.98px) {
  .offcanvas-collapse {
    position: fixed;
    top: 56px; /* Height of navbar */
    bottom: 0;
    left: -100%;
    width: 250px;
    padding-right: 1rem;
    padding-left: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: #3c4249;
    transition-timing-function: ease-in-out;
    transition-duration: .3s;
    transition-property: left, visibility;
    z-index: 99;
  }
  .offcanvas-collapse.open {
    left: 0;
    visibility: visible;
  }
}

.nav-scroller {
  position: relative;
  z-index: 2;
  height: 2.75rem;
  overflow-y: hidden;
}

.nav-scroller .nav {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  padding-bottom: 1rem;
  margin-top: -1px;
  overflow-x: auto;
  color: rgba(255, 255, 255, .75);
  text-align: center;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}

.nav-underline .nav-link {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: .875rem;
  color: #6c757d;
}

.nav-underline .nav-link:hover {
  color: #007bff;
}

.nav-underline .active {
  font-weight: 500;
  color: #343a40;
}

.text-white-50 { color: rgba(255, 255, 255, .5); }

.bg-purple { background-color: #6f42c1; }

.lh-100 { line-height: 1; }
.lh-125 { line-height: 1.25; }
.lh-150 { line-height: 1.5; }
</style>
