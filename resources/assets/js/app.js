
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#employees',
    data: {
        employees: {},
        options: {
            search_query: '',
            search_sex: [],
            search_age_from: '',
            search_age_to: ''
        },
        pagination: {
            total: 0,
            per_page: 5,
            from: 1,
            to: 0,
            current_page: 1
        }
    },
    computed: {
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    mounted: function () {
        this.get_employees();
    },
    methods: {
        get_employees: function(page = null) {
            this.$http.post('/employee/get' + (page ? ('/?page=' + page) : ''), this.options).then(response => {
                this.employees = response.data.data.data;
                this.pagination = response.data.pagination;
            })
        }
    }
});
