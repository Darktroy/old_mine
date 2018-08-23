$('select').select2();
// Sectors Select2
$('.sectors').select2({
    placeholder: 'Select Sectors',
    minimumInputLength: 0,
    multiple: true,
    allowClear: true,
    data: function () {
        return {
            results: sectors
        }
    },
}).select2('val', [company_sectors]);

// Register
if (document.getElementById('register')) {
    new Vue({
        el: "#register",
        data: {
            counts: 1
        },
        components: {
            addressComp: {
                template: '#new-address',
                props: ['nameCount']
            },
        },
        methods: {
            addAddress: function () {
                this.counts++;
            },
            otherType: function () {

            }
        }
    });
}

// Setting Section
new Vue({
    el: "#address",
    data: {
        counts: address_count,
        address: address,
        types: address_types,
        old_password: null,
    },
    components: {
        addressComp: {
            template: '#new-address',
            props: ['nameCount', 'types', 'index']
        },
    },
    methods: {
        addAddress: function () {
            new_address = {
                address: '',
                addressId: '',
                company_id: '',
                postal: '',
                typename: '',
                type_id: ''
            };
            this.address.push(new_address);
        }
    },

});

//  Password Section
if (document.getElementById('password')) {
    new Vue({
        el: "#password",
        data: {
            old_password: '',
            status: false,
            disabled: true
        },
        methods: {
            currentPassword: function (url, token) {
                axios.post(url, {
                    'password': this.old_password,
                    'token': token
                }).then(response => {
                    if (response.data.status === true) {
                        this.status = true;
                        this.disabled = false;
                    } else if (response.data.status === false) {
                        this.status = false;
                        this.disabled = true;
                    }
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    });

}


var phone_counts = 0;
$('.new_phone').on('click', function (e) {
    e.preventDefault();
    phone_counts++;
    $('.phones-container').append(`<div class="phones">
                        <label for="phone"> Phone * </label>
                        <input type="text" name="phones[${phone_counts}]" id="">
                    </div>`);
});

var fax_counts = 0;
$('.new_fax').on('click', function (e) {
    e.preventDefault();
    fax_counts++;
    $('.faxes-container').append(`<div class="faxes">
                        <label for="faxes"> Fax * ${fax_counts} </label>
                        <input type="text" name="faxes[${fax_counts}]" id="">
                    </div>`);
});