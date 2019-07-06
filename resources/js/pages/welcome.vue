<template>
  <div class="container">
    <div class="top-left links d-none d-sm-block">
      <router-link :to="{ name: 'documentation' }" :class="'text-orange'">
        <fa icon="book" fixed-width /> {{ $t('documentation') }}
      </router-link>
      <!-- <a href="https://join.slack.com/t/metagrenade/shared_invite/enQtNjc1MjQ0ODc4OTE5LTNhM2RlN2M5NmM2ODBjOTYwY2Q4ZTljYjYwZmY4NTMzZWMzNDZkY2YxMzk2NTNlNTZmNmY3ZTEzZmE3YmQyM2M" class="text-slack" target="_blank"><fa :icon="['fab', 'slack']" fixed-width/> Join Slack Chat</a> -->
    </div>
    <div class="top-right links">
      <template v-if="authenticated">
        <router-link :to="{ name: 'home' }">
          <fa icon="home" fixed-width /> {{ $t('home') }}
        </router-link>
      </template>
      <template v-else>
        <router-link :to="{ name: 'login' }">
          {{ $t('login') }}
        </router-link>
        <router-link :to="{ name: 'register' }">
          {{ $t('register') }}
        </router-link>
      </template>
    </div>

    <div class="row">
      <div class="col-12 text-center">
        <div class="col-12 col-lg-8 mx-auto mt-4">
          <img src="/img/logo_orange.png" class="img-fluid my-4" alt="MetaGrenade - Lavael Vue SPA Boilerplate">
        </div>
        <h1>Laravel Vue SPA</h1>
        <div class="col-12 col-lg-6 mx-auto">
          <p class="mx-auto text-muted">A Simple & Powerful, Open-source Boilerplate for <strong>API Powered</strong> <i>'Single Page Applications'</i> Using <u>Laravel 5.8</u> & <u>Vue 2</u>.</p>
        </div>
        

        <div class="col-12 mt-4">
          <a class="btn btn-light btn-orange mb-2" href="#">
            Download v0.0.1 <fa :icon="'download'" fixed-width/>
          </a>
          <a class="btn btn-light border-primary text-primary mb-2" href="https://github.com/metagrenade/laravel-vue-spa" target="_blank">
            View on GitHub <fa :icon="['fab', 'github']" fixed-width/>
          </a>
          <a href="https://join.slack.com/t/metagrenade/shared_invite/enQtNjc1MjQ0ODc4OTE5LTNhM2RlN2M5NmM2ODBjOTYwY2Q4ZTljYjYwZmY4NTMzZWMzNDZkY2YxMzk2NTNlNTZmNmY3ZTEzZmE3YmQyM2M" class="btn btn-light btn-slack mb-2" target="_blank">Join Slack Chat <fa :icon="['fab', 'slack']" fixed-width/></a>
        </div>
        <div class="col-12 links mb-4 d-block d-sm-none">
          <router-link :to="{ name: 'documentation' }" class="text-orange">
            <fa icon="book" fixed-width /> {{ $t('documentation') }}
          </router-link>
        </div>
        <div class="col-12 links mb-4 d-none d-sm-block">
          <p class="text-muted">Made with <fa :icon="'heart'" :class="'text-danger'" fixed-width/> by a Community of Developers!</p>
        </div>
      </div>

      <div class="col-12 col-lg-6">
        <h3 class="text-center">Tech Stack:</h3>
        <div class="row">
          <div class="col-12 col-lg-6 mb-4">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://laravel.com/docs/5.8" target="_blank">Laravel</a>
                <span class="badge badge-primary badge-pill">5.8.*</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://router.vuejs.org/" target="_blank">VueRouter</a>
                <span class="badge badge-primary badge-pill">3.0.6</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://vuex.vuejs.org/" target="_blank">VueX</a>
                <span class="badge badge-primary badge-pill">3.1.1</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://www.npmjs.com/package/vue-i18n" target="_blank">VueI18n</a>
                <span class="badge badge-primary badge-pill">8.11.2</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://vue-meta.nuxtjs.org/" target="_blank">Vue Meta</a>
                <span class="badge badge-primary badge-pill">1.6.0</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://eslint.org/" target="_blank">ESlint</a>
                <span class="badge badge-primary badge-pill">5.16.0</span>
              </li>
            </ul>
          </div>
          <div class="col-12 col-lg-6 mb-4">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://github.com/axios/axios" target="_blank">Axios</a>
                <span class="badge badge-primary badge-pill">0.18.1</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://github.com/tymondesigns/jwt-auth" target="_blank">JWT Auth</a>
                <span class="badge badge-primary badge-pill">1.0.0-rc.4.1</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://github.com/laravel/socialite" target="_blank">Socialite</a>
                <span class="badge badge-primary badge-pill">4.0</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://sweetalert2.github.io/" target="_blank">Sweet Alert 2</a>
                <span class="badge badge-primary badge-pill">8.12.1</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://getbootstrap.com/docs/4.3/getting-started/introduction/" target="_blank">Bootstrap</a>
                <span class="badge badge-primary badge-pill">4.3.1</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://fontawesome.com/how-to-use/on-the-web/referencing-icons/basic-use" target="_blank">Font Awesome</a>
                <span class="badge badge-primary badge-pill">5.9.0</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <h3 class="text-center">Features:</h3>
        <div class="list-group mb-4">
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Blog Management</h5>
              <small class="text-success">Ready</small>
            </div>
            <p class="mb-1">Public and Private API driven Blog Management with Categories & More!</p>
            <small class="text-muted">List, View, Admin.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Roles & Permissions Manager</h5>
              <small class="text-warning">Work In Progress</small>
            </div>
            <p class="mb-1">Powerful Roles & Permissions Manager, putting the power of ACL at your disposal!</p>
            <small class="text-muted">Roles, Permissions, Admin</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">User Manager</h5>
              <small class="text-warning">Work In Progress</small>
            </div>
            <p class="mb-1">View & Manage your applications Users, the Roles they belong to & Permissions they have!</p>
            <small class="text-muted">Users, Roles & Permissions, Admin</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Bulk Emailing System</h5>
              <small class="text-primary">Planned</small>
            </div>
            <p class="mb-1">Send Email notifications to individual users, or all users within a specified role/group.</p>
            <small class="text-muted">???</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Push Notifications</h5>
              <small class="text-primary">Planned</small>
            </div>
            <p class="mb-1">Send real time push notifications to individual users, or all users within a specified role/group.</p>
            <small class="text-muted">Powered by Pusher</small>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <small class="text-muted"><fa :icon="['fab', 'github']" fixed-width/> Extended from <a href="https://github.com/cretueusebiu/laravel-vue-spa" target="_blank">cretueusebiu/laravel-vue-spa</a></small>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style lang="scss" scoped>
@import "node_modules/bootstrap/scss/functions";
@import "node_modules/bootstrap/scss/variables";
@import "node_modules/bootstrap/scss/mixins/_breakpoints";

h1 {
  @include media-breakpoint-only(xs) {
    font-size: 25px;
  }
  @include media-breakpoint-only(sm) {
    font-size: 35px;
  }
  @include media-breakpoint-only(md) {
    font-size: 45px;
  }
  @include media-breakpoint-only(lg) {
    font-size: 55px;
  }
  @include media-breakpoint-only(xl) {
    font-size: 75px;
  }
}
  
.top-left {
  position: absolute;
  left: 10px;
  top: 18px;
  z-index: 1000;
}

.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
  z-index: 999;
}

.links > a:hover {
  opacity: 0.5;
  filter: opacity(0.5);
}

.text-slack {
  color: #4a154b !important;
}

p {
  
  @include media-breakpoint-only(xs) {
    font-size: 18px;
  }
  @include media-breakpoint-only(sm) {
    font-size: 18px;
  }
  @include media-breakpoint-only(md) {
    font-size: 20px;
  }
  @include media-breakpoint-only(lg) {
    font-size: 22px;
  }
  @include media-breakpoint-only(xl) {
    font-size: 24px;
  }
}

.list-group {
  p {
    font-size: 16px;
  }
}

ul {
  list-style: none;
}
</style>
