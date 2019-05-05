import Vue from 'vue'
import Router from 'vue-router'
import Main from '../components/user/Mian'
import ThemeList from "../components/user/ThemeList";
import ThemeInfo from "../components/user/ThemeInfo";
import UserCenter from "../components/user/UserCenter"
Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Main',
      component: Main,
      children: [
        {
          path: '',
          component: ThemeList
        },
        {
          path : 'theme_info',
          component: ThemeInfo
        },
        {
          path: 'user/center',
          component: UserCenter
        }
      ]
    }
  ]
})
