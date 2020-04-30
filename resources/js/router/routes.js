function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
// INDEX / LANDING / SPLASH
  { path: '/', name: 'welcome', component: page('welcome.vue') },
// GUEST & MISC
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/set-password/:id', name: 'password.set.password', component: page('auth/password/set-password.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
// HOME / DASHBOARD
  { path: '/home', name: 'home', component: page('home.vue') },
// BLOG
  { path: '/blog', name: 'blog', component: page('blog.vue') },
  { path: '/blog/:category', name: 'blog.category', component: page('blog.vue') },
  { path: '/blog/:category/:year/:month/:slug', name: 'blog.view', component: page('blog-view.vue') },
// Documentation
  { path: '/documentation', name: 'documentation', component: page('documentation.vue')},
// USER PROFILE
  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },
// ADMIN
  { path: '/admin',
    component: page('admin/index.vue'),
    meta :{employee:true,owner:true,permission:'common'},
    children: [
      { path: '', redirect: { name: 'admin.dashboard' } , meta :{employee:true,owner:true,permission:'common'}},
      { path: 'dashboard', name: 'admin.dashboard', component: page('admin/dashboard.vue') ,meta :{employee:true,owner:true,permission:'common'}},
      { path: 'roles', name: 'admin.roles', meta :{employee:true,owner:true,permission:'view-role'}, component: page('admin/roles.vue') },
      { path: 'roles/createroles', name: 'admin.createRoles', meta :{employee:true,owner:true,permission:'create-role'}, component: page('admin/createRole.vue') },
      { path: 'users', name: 'admin.users', meta :{employee:true,owner:true,permission:'view-user'},component: page('admin/users.vue') },
      { path: 'create-users', name: 'admin.create.users', meta :{employee:true,owner:true,permission:'create-user'},component: page('admin/create-users.vue') },
      { path: 'edit-users/:id', name: 'admin.edit.users', meta :{employee:true,owner:true,permission:'edit-user'},component: page('admin/edit-users.vue') },
      { path: 'blogs/edit/:id', name: 'admin.blogs.edit',meta :{employee:true,owner:true,permission:'edit-blog'}, component: page('admin/blogs-edit.vue') },
      { path: 'blogs/create', name: 'admin.blogs.create',meta :{employee:true,owner:true,permission:'create-blog'}, component: page('admin/blogs-create.vue') },
      { path: 'blogs', name: 'admin.blogs',meta :{employee:true,owner:true,permission:'view-blog'}, component: page('admin/blogs.vue') },
  /*Emails Templates*/
      { path: 'emails', name: 'admin.emails',meta :{employee:true,owner:true,permission:'view-email-template'}, component: page('admin/emails.vue') },
      { path: 'edit-email-templates/:id', name: 'admin.edit.email.templates',meta :{employee:true,owner:true,permission:'edit-email-template'}, component: page('admin/edit-email-templates.vue') },
      { path: 'send-bulk-emails', name: 'admin.send.bulk.emails',meta :{employee:true,owner:true,permission:'send-bulk-emails'}, component: page('admin/send-bulk-emails.vue') },


    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
