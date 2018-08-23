/**
 * Created by mekadoo on 9/16/17.
 */
// Company Calls
new Vue({
    el: '#calls_listing',
    data: {
        calls: calls.data,
        calls_status: true,
        looking_for: looking_for,
        places: places
    },
    components: {
        callRecord: {
            template: '#call-record',
            props: ['calls', 'looking_for', 'places']
        },
    },
    methods: {
        filter: function () {
            alert('clicked');
        }
    }

})

new Vue({
    el: '#filter',
    data: {
        selected: '',
    },
    methods: {
        filter: function (url) {
            var url = url + '/' + this.selected;
            axios.get(url, {}).then(response => function () {
                console.log(response);
            }).catch(errors => function () {
                console.log(errors);
            })
        }
    }

})