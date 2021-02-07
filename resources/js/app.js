require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)
import routes from './routes'

import App from './components/App.vue'

import VeeValidate, { Validator } from 'vee-validate';
import VeeValidateLaravel from 'vee-validate-laravel';

const dictionary = {
    custom: {
        postal_code: {
          required: 'Postleitzahl ist erforderlich',
          numeric: 'Die Postleitzahl sollte numerisch sein',
          length: 'Die Postleitzahl sollte 5-stellig sein',
        },
        zip: {
          required: 'Postleitzahl ist erforderlich',
        },
        street: {
          required: 'Straße ist erforderlich',
          min: 'Straße sollte mindestens 3 Buchstaben haben',
          max: 'Street should have maximum 30 letters',
        }
      }
  };
  
  
  Vue.use(VeeValidate);
  
  Validator.localize('de', dictionary);

  Validator.localize('de'); // changes the locale

  Validator.localize(dictionary);

  Vue.use(VeeValidateLaravel);


const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes)
})
