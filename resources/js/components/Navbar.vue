<template>
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid px-0">
      <router-link :to="{ name: user ? 'welcome' : 'welcome' }" class="navbar-brand">
        {{ appName }}
      </router-link>

      <button class="navbar-toggler" type="button" data-toggle="offcanvas" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false"
              :class="{ 'osc-active': isOffcanvas }"
              @click="offcanvas"
      >
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarToggler" class="offcanvas-collapse navbar-collapse" :class="{ open: isOffcanvas }">
        <ul class="navbar-nav mr-auto">
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li> -->
          <div @click="offcanvas">
            <router-link :to="{ name: 'documentation' }" tag="li">
              <a class="nav-link text-orange" href="#">
                <fa icon="book" fixed-width />
                {{ $t('documentation') }}
              </a>
            </router-link>
          </div>
          <div @click="offcanvas">
            <router-link :to="{ name: 'blog' }" tag="li">
              <a class="nav-link" href="#">
                <fa icon="newspaper" fixed-width />
                {{ $t('blog') }}
              </a>
            </router-link>
          </div>
          <locale-dropdown />
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="dropdown-divider" />
          <!-- Authenticated -->
          <div @click="offcanvas">
            <router-link v-if="user" :to="{ name: 'admin.dashboard' }" tag="li">
              <a v-if="user.role=='super-admin'" class="nav-link text-orange" href="#">
                <fa  icon="shield-alt" fixed-width />
               Admin
              </a>
              <a v-else class="nav-link text-orange" href="#">
                <fa  :icon="user.roles[0].icon" fixed-width />
              {{user.roles[0].title}}
              </a>
            </router-link>
          </div>
          <div @click="offcanvas">
            <router-link v-if="user" :to="{ name: 'home' }" tag="li">
              <a class="nav-link text-primary" href="#">
                <fa icon="home" fixed-width />
                {{ $t('home') }}
              </a>
            </router-link>
          </div>
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div @click="offcanvas">
                <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                  <fa icon="cog" fixed-width />
                  {{ $t('settings') }}
                </router-link>
              </div>
              <div class="dropdown-divider" />
              <div @click="offcanvas">
                <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                  <fa icon="sign-out-alt" fixed-width />
                  {{ $t('logout') }}
                </a>
              </div>
            </div>
          </li>
          <li v-if="user" class="nav-item dropdown">
            <div class="panel panel-default">
              <div class="panel-body">
                <!-- Single button -->
                <div class="btn-group pull-right top-head-dropdown">
                  <button style="color: #fff" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Notification <span class="badge badge-light">{{notifications.length}}</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">

                    <li v-for="item in notifications">
                      <a href="javascript:void(0)" v-if="item.type=='App\\Notifications\\postBlogNotification' || item.type=='postBlog'" @click="markAsread(item.id)" class="top-text-block">
                        <div class="top-text-heading">{{item.data.name}}<b >&nbsp;&nbsp;Post a Blog</b></div>
                        <div class="top-text-light">{{item.created_at | dataFormat  }}</div>
                      </a>

                      <a href="javascript:void(0)" v-if="item.type=='App\\Notifications\\publishNotification'" @click="markAsread(item.id)" class="top-text-block">
                        <div class="top-text-heading">{{item.data.title}}<b >&nbsp;&nbsp;has been published</b></div>
                        <div class="top-text-light">{{item.created_at | dataFormat  }}</div>
                      </a>
                      <a href="javascript:void(0)" v-if="item.type=='App\\Notifications\\unpublishnotification'" @click="markAsread(item.id)" class="top-text-block">
                        <div class="top-text-heading">{{item.data.title}}<b >&nbsp;&nbsp;has been un-published</b></div>
                        <div class="top-text-light">{{item.created_at | dataFormat  }}</div>
                      </a>
                    </li>
<!--                    <li>-->
<!--                      <a href="#" class="top-text-block">-->
<!--                        <div class="top-text-heading">New asset recommendations in <b>5 themes</b></div>-->
<!--                        <div class="top-text-light">4 hours ago</div>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <a href="#" class="top-text-block">-->
<!--                        <div class="top-text-heading">Assets specifications modified in themes</div>-->
<!--                        <div class="top-text-light">4 hours ago</div>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <a href="#" class="top-text-block">-->
<!--                        <div class="top-text-heading">We crawled <b>www.dell.com</b> successfully</div>-->
<!--                        <div class="top-text-light">5 hours ago</div>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <a href="#" class="top-text-block">-->
<!--                        <div class="top-text-heading">Next crawl scheduled on <b>10 Oct 2016</b></div>-->
<!--                        <div class="top-text-light">6 hours ago</div>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <a href="#" class="top-text-block">-->
<!--                        <div class="top-text-heading">You have an update for <b>www.dell.com</b></div>-->
<!--                        <div class="top-text-light">7 hours ago</div>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <a href="#" class="top-text-block">-->
<!--                        <div class="top-text-heading"><b>"Gaming Laptop"</b> is now trending</div>-->
<!--                        <div class="top-text-light">7 hours ago</div>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <a href="#" class="top-text-block">-->
<!--                        <div class="top-text-heading">New asset recommendations in <b>Gaming Laptop</b></div>-->
<!--                        <div class="top-text-light">7 hours ago</div>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <div class="loader-topbar"></div>-->
<!--                    </li>-->
                  </ul>
                </div>
              </div>
            </div>

          </li>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item" @click="offcanvas">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
            <li class="nav-item" @click="offcanvas">
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
import moment from 'moment'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName,
    isOffcanvas: true,
    role:{},
    notifications:[]
  }),
  filters: {
    dataFormat(value) {
      if (value) {

        var time = moment.utc(value).zone(+120).format()

        return moment(time).fromNow();
      }
    },
  },
  created(){
    this.getUnreadNotification();
    let data=JSON.parse(localStorage.getItem('user-detail'));
    if(data.role=='super-admin'){
      this.role=data.role;

    }else{
      if(data.roles.length){
        this.role=data.roles;
      }
    }

  },

  computed: {
    isUserSuperAdmin () {
      if (this.user && this.user.role === 'super-admin') {
        return true
      } else {
        return false
      }
    },
    isUserAdmin () {
      if (this.user ) {
        return true
      } else {
        return false
      }
    },
    ...mapGetters({
      user: 'auth/user'
    })
  },
  mounted(){
    const user_detail=localStorage.getItem('userDetail');
    const userData = JSON.parse(localStorage.getItem('user_detail'));


   console.log(userData.id);

    Echo.private('App.User.' + userData.id).notification((notification)  =>{
      console.log(JSON.stringify(notification));
      this.notifications.unshift(notification);

    });
  },

  methods: {
    getUnreadNotification(){
      axios.get('api/v1/notification-management/notification')
              .then(response=>{
                this.notifications=response.data.data.map(item=>({data:item.data.data,id:item.id,type:item.type,created_at:item.created_at}));
                // console.log(JSON.stringify(response.data.data));
                // let item=response.data.data.map(item=>({data:item.data.data,id:item.id,type:item.type}))
                // console.log(JSON.stringify(item));
              })
              .catch(error=>{

              })
    },
    markAsread(id){

      axios.post('api/v1/notification-management/notification',{id:id})
              .then(request=>{
                var found=_.find(this.notifications,['id',id]);
                this.notifications.splice(id,1);
              })
              .catch(error=>{
               alert('no');
              })
    },
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },
    offcanvas: function () {
      if (this.isOffcanvas === false) {
        this.isOffcanvas = true
      } else {
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
.top-text-block{
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: 400;
  line-height: 1.42857143;
  color: #333;
  white-space: inherit !important;
  border-bottom:1px solid #f4f4f4;
  position:relative;
  &:hover {
    &:before {
      content: '';
      width: 4px;
      background: #f05a1a;
      left: 0;
      top: 0;
      bottom: 0;
      position: absolute;
    }
  }
  &.unread {
    background:#ffc;

    // &:hover {
    //   background:#ffd;
    // }
  }

  .top-text-light {
    // color:#ccc;
    color: #999;
    font-size: 0.8em;
  }
}

.top-head-dropdown {
  .dropdown-menu {
    width: 350px;
    height:300px;
    overflow:auto;
  }

  li:last-child{
    .top-text-block {
      border-bottom:0;
    }
  }
}
.topbar-align-center {
  text-align: center;
}
.loader-topbar {
  margin: 5px auto;
  border: 3px solid #ddd;
  border-radius: 50%;
  border-top: 3px solid #666;
  width: 22px;
  height: 22px;
  -webkit-animation: spin-topbar 1s linear infinite;
  animation: spin-topbar 1s linear infinite;
}

@-webkit-keyframes spin-topbar {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin-topbar {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
