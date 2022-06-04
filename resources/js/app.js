/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue').default;

window.EventDispatcher = new class {
    constructor() {
        this.Vue = new Vue();
    }
    
    fire(event, data=null) {
        this.Vue.$emit(event, data);
    }

    listen(event, callback) {
        this.Vue.$on(event, callback)
    }
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app-component', require('./components/App.vue').default);
Vue.component('message-component', require('./components/Message.vue').default);
Vue.component('counter-component', require('./components/Counter.vue').default);
Vue.component('register-component', require('./components/Register.vue').default);
Vue.component('login-component', require('./components/Login.vue').default);
Vue.component('forgot-password-component', require('./components/Forgot-Password.vue').default);
Vue.component('reset-password-component', require('./components/Reset-Password.vue').default);
Vue.component('edit-profile-component', require('./components/Edit-Profile.vue').default);
Vue.component('create-pet-profile-component', require('./components/Create-Pet-Profile.vue').default);
Vue.component('pet-profile-component', require('./components/Pet-Profile.vue').default);
Vue.component('update-coverage-area-component', require('./components/Update-Coverage-Area-Component.vue').default);
Vue.component('volunteer-registration-component', require('./components/Volunteer-Registration.vue').default);
Vue.component('new-medical-fund-component', require('./components/Start-New-Medical-Fund.vue').default);


Vue.component('count-box', {
    props: ['count', 'info'],

    template: `
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h3>{{count}}</h3>
            
                        <p>{{info}}</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                        </div>
                        <button type="button" @click="popup"> CLICK </button>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    `,
    methods: {
        popup() {
            alert('hello');
        }
    }
});

Vue.component('tabs', {
    template: `
        <div>
            <div class="tabs">
                <ul>
                    <li v-for="tab in tabs" :class="{ 'is-active': tab.isActive }">
                        <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
                    </li>
                </ul>
            </div>
            <div class="tabs-details">
                <slot></slot>
            </div>
        </div>
    `,

    data() {
        return { tabs: [] };
    },

    created() {
        this.tabs = this.$children;
    },

    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.href == selectedTab.href);
            });
        }
    }
});


Vue.component('tab', {
    template: `
        <div v-show="isActive"><slot></slot></div>
    `,

    props: {
        name: { required: true },
        selected: { default: false }
    },

    data() {
        return {
            isActive: false
        };
    },

    computed: {
        href() {
            return '#' + this.name.toLowerCase().replace(/ /g, '-');
        }
    },

    mounted() {
        this.isActive = this.selected;
    },
});

// Vue.component('coupon', {
//     template: `
//         <input placeholder="Enter Coupon" @blur="onCouponApplied"></input>
//     `,
//     methods: {
//         onCouponApplied() {
//             this.$emit('applied');
//         }
//     }
// });

Vue.component('coupon', {
    template: `<input placeholder="Enter your coupon code" @blur="onCouponApplied">`,
 
     methods: {
        onCouponApplied() {
            EventDispatcher.fire('applied');
        }
     }
 });

Vue.component('modal', {
    template: `
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title"><slot name="header"></slot></p>
                <button class="delete" aria-label="close" @click="$emit('close')"></button>
            </header>

            <section class="modal-card-body">
                <slot></slot>
            </section>
            
            <footer class="modal-card-foot">
                <slot name="footer">
                    <button class="button" @click="$emit('close')">Cancel</button>
                </slot>
            </footer>
        </div>
    </div>
    `
});

Vue.component('progress-view', {
    data() {
        return {
            completionRate: 10
        };
    }
});

 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
const app = new Vue({
    el: '#app',
    data: {
        showModal: false,
        couponApplied: false,
        skills: []
    },
    // methods: {
    //     onCouponApplied() {
    //         this.couponApplied = true;
    //     }
    // },
    created() {
        EventDispatcher.listen('applied', () => this.couponApplied = true);
    },
    mounted() {
        axios.get('/skills').then(response => this.skills = response.data);
    }
});