import '@fortawesome/fontawesome-free/js/all'

import Vue from 'vue'
import notification from './components/notification';

const app = new Vue({
    el: '#vue-app',

    components:{
        notification
    }
});

try {

    window.$ = window.jQuery = require('jquery');

    window.fn = require('bootstrap-datepicker');

} catch (e) {}


