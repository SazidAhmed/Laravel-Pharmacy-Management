
require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';

//Medicine Components
Vue.component('category', require('./components/medicine/CategoryComponent.vue').default);
Vue.component('manufact', require('./components/medicine/ManufactComponent.vue').default);
Vue.component('medicine', require('./components/medicine/MedicineComponent.vue').default);
Vue.component('units', require('./components/medicine/UnitsComponent.vue').default);

//User Management Components
Vue.component('profile', require('./components/user/ProfileComponent.vue').default);
Vue.component('userlist', require('./components/user/UserListComponent.vue').default);


//POS Components  Cart, Invoice, Customer
Vue.component('customer', require('./components/pos/CustomerComponent.vue').default);
Vue.component('cart', require('./components/pos/CartComponent.vue').default);
Vue.component('invoice', require('./components/pos/InvoiceComponent.vue').default);
Vue.component('invoicerecord', require('./components/pos/InvoiceRecordComponent.vue').default);
Vue.component('solditems', require('./components/pos/SoldItemsComponent.vue').default);

//Report Components
Vue.component('todaysales', require('./components/reports/TodaySalesComponent.vue').default);
Vue.component('weeklysales', require('./components/reports/WeeklySalesComponent.vue').default);
Vue.component('monthlysales', require('./components/reports/MonthlySalesComponent.vue').default);
Vue.component('yearlysales', require('./components/reports/YearlySalesComponent.vue').default);

//Datatables
Vue.component('datatables', require('./components/datatables/Datatables.vue').default);

//Dashboard Components
Vue.component('countitem', require('./components/dashboard/CountItemComponent.vue').default);
Vue.component('totalearning', require('./components/dashboard/TotalEarningComponent.vue').default);
Vue.component('notify', require('./components/dashboard/NotificationComponent.vue').default);
Vue.component('expire', require('./components/dashboard/ExpireComponent.vue').default);

// Graph Components
Vue.component('barchart', require('./components/graphs/BarchartComponent.vue').default);
Vue.component('linechart', require('./components/graphs/LinechartComponent.vue').default);
Vue.component('doughnut', require('./components/graphs/DoughnutComponent.vue').default);
Vue.component('pie', require('./components/graphs/PieComponent.vue').default);
Vue.component('radar', require('./components/graphs/RadarComponent.vue').default);


//filters
Vue.filter('upText', function (text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('myDate', function (value) {
  return moment(value).format('Do MMMM YYYY');
  // return moment(value).format('MMMM Do YYYY, h:mm:ss a');
});
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
})

//Component communication
window.Fire = new Vue();

const app = new Vue({
  el: '#app',
});

const notify = new Vue({
  el: '#notify',
});

const expire = new Vue({
  el: '#expire',
});
