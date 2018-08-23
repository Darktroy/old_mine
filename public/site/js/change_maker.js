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
                        this.status = true,
                            this.disabled = false
                    } else {
                        this.status = false,
                            this.disabled = true
                    }
                }).catch(error => {

                    console.log(error)
                })
            }
        }
    });
}