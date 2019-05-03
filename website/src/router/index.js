import Vue from 'vue'
import Router from 'vue-router'
import Main from '../components/user/Mian'
import ThemeList from "../components/user/ThemeList";

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Main',
      component: Main,
      children: [
        {
          path: '',
          component: ThemeList
        }
      ]
    }
  ]
})
