import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/components/Main'
import HelloWorld from '@/components/HelloWorld'

Vue.use(Router)

export default new Router({
  routes: [{
    path: '/Main',
    name: 'Main',
    component: Main
  }, {
    path: '/HelloWorld',
    name: 'HelloWorld',
    component: HelloWorld
  }]
})
