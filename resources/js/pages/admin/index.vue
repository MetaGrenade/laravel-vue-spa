<template>

  <div class="row px-2">

    <div class="col-md-3 my-4">
        <card :title="$t('admin')" class="settings-card">
          <ul class="nav flex-column nav-pills">
          <li   key=""  class="nav-item">
            <router-link to="/admin/dashboard"  class="nav-link" active-class="active">
              <fa icon="tachometer-alt" fixed-width />
              Dashboard
            </router-link>
          </li>
          <li v-for="permission in permissions"  v-show="permission.value==='view-role'"     class="nav-item">
            <router-link to="/admin/roles"  class="nav-link" >
              <fa icon="shield-alt" fixed-width />
              Role
            </router-link>
          </li>

          <li  v-for="permission in permissions"  v-show="permission.value==='view-user'"     class="nav-item">
            <router-link to="/admin/users"  class="nav-link" >
              <fa icon="user" fixed-width />
              Users
            </router-link>
          </li>

          <li   v-for="permission in permissions"  v-show="permission.value==='view-blog'"    class="nav-item">
            <router-link to="/admin/blogs"  class="nav-link" >
              <fa icon="book" fixed-width />
              Blogs
            </router-link>
          </li>

            <li   v-for="permission in permissions"  v-show="permission.value==='view-email-template'"    class="nav-item">
            <router-link to="/admin/emails"  class="nav-link" >
              <fa icon="newspaper" fixed-width />
              Email Templates
            </router-link>
          </li>


        </ul>
    <!--  <card :title="$t('admin')" class="settings-card">-->
        <!--<ul class="nav flex-column nav-pills">
          <li v-for="tab in tabs"   :key="tab.route"  class="nav-item">
            <router-link :to="{ name: tab.route }"  class="nav-link" active-class="active">
              <fa :icon="tab.icon" fixed-width />
              {{ tab.name }}
            </router-link>
          </li>
        </ul>-->
      </card>
    </div>

    <div class="col-md-9 my-4">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'admin',
  data(){
    return{
      role:'',
      tabs:[{
        icon: 'tachometer-alt',
        name: this.$t('dashboard'),
        route: 'admin.dashboard',
        permission:""
      },
        {
          icon: 'shield-alt',
          name: this.$t('roles'),
          route: 'admin.roles',
          permission:"view_role"
        },
        {
          icon: 'user',
          name: this.$t('users'),
          route: 'admin.users',
          permission:"view_user",
          permission_status:false,

        },
        {
          icon: 'newspaper',
          name: this.$t('blogs'),
          route: 'admin.blogs',
          permission:"view_blogs",
          permission_status:false,
        }],
      ars:'hgh',
      permissions:[]
    }
  },
  created(){
    let data=localStorage.getItem('user_detail');
    let parsData=JSON.parse(data);
    this.role=parsData.role;

   this.permissions=parsData.roles[0].permissions.map(item=>({value:item.slug,id:item.id}));

  },
  beforeEnter(){
     console.log('sadsa');
    next();
  },
  methods:{
    checkPermission(permisson){
      this.permissions.forEach(el=>{
        if(el.value==permisson){
          console.log(permisson);
          return true;
        }else{
          return false;
        }
      })
    },
  },
  computed: {


    ...mapGetters({
      user: 'auth/user'
    })
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
