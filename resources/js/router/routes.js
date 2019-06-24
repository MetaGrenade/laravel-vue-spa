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
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
// HOME / DASHBOARD
  { path: '/home', name: 'home', component: page('home.vue') },
// BLOG
  { path: '/blog', name: 'blog', component: page('blog.vue') },
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
    children: [
      { path: '', redirect: { name: 'admin.dashboard' } },
      { path: 'dashboard', name: 'admin.dashboard', component: page('admin/dashboard.vue') },
      { path: 'roles', name: 'admin.roles', component: page('admin/roles.vue') },
      { path: 'users', name: 'admin.users', component: page('admin/users.vue') },
      { path: 'blogs/edit/:id', name: 'admin.blogs.edit', component: page('admin/blogs-edit.vue') },
      { path: 'blogs/create', name: 'admin.blogs.create', component: page('admin/blogs-create.vue') },
      { path: 'blogs', name: 'admin.blogs', component: page('admin/blogs.vue') },
    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
