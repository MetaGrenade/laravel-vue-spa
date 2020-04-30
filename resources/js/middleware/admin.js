import store from '~/store'

export default (to, from, next) => {
  if (!store.getters['auth/check']) {
    next({ name: 'login' })
  }

  let routePremission=to.meta.permission;
  const userDetail=localStorage.getItem('user_detail');
  const userData=JSON.parse(userDetail);
 const userrole=userData.role;
  const role=userData.roles[0].permissions;

  var found=role.some(function(el){
    if(routePremission==='common'){
      return true;
    }else{
      return el.slug===routePremission;
    }
  })


  if (!store.getters['auth/check']) {
    next({ name: 'login' })
  } else {
    if (found) {

      next();
    }  else {
      //next();
      next({name: 'home'})
    }
  }

}
