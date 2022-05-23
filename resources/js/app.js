 require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('send-message', require('./components/SendMessage.vue').default);
Vue.component('user-chat', require('./components/UserChat.vue').default);
Vue.component('admin-chat', require('./components/AdminChat.vue').default);


//Sweet alert
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: false,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast;
//End: Sweet alert

//Vue Chat Scroll
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)
//End: Vue Chat Scroll

const app = new Vue({
    el: '#app',
});
