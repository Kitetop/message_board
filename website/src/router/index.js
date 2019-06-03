import Vue from 'vue'
import Router from 'vue-router'
import Main from '../components/user/Mian'
import ThemeList from "../components/user/ThemeList";
import ThemeInfo from "../components/user/ThemeInfo";
import UserCenter from "../components/user/UserCenter"
import Login from "../components/Login";
import ManageUser from "../components/admin/ManageUser";
import ReportList from "../components/admin/ReportList";
import AddTheme from "../components/AddTheme";
import Register from "../components/user/Register";
import AdminMain from "../components/admin/Main"

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
          path: 'index',
          component: ThemeList
        },
        {
          path : 'index/theme_info',
          component: ThemeInfo
        },
        {
          path : 'add/theme',
          component: AddTheme
        },
        {
          path: 'user/center',
          component: UserCenter
        },
        {
          path: 'user/login',
          component: Login,
        },
        {
          path: 'user/register',
          component: Register,
        },
      ]
    },
    {
      path: '/admin',
      name: 'Main',
      component: AdminMain,
      children: [
        {
          path: 'user',
          component: ManageUser
        },
        {
          path: 'report',
          component: ReportList
        }
      ]
    },
    {
      path: '*',
      redirect: '/index',

    }
  ]
})
