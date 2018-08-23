if (document.getElementById('call_actions')) {
    new Vue({
        el: '#call_actions',
        data: {
            status: '',
            activation: '',
        },
        methods: {
            approveCall: function (url) {
                if (!confirm('Are You Sure You Want To Approve this Call')) {
                    return false;
                }
                axios.get(url, {}).then(response => {
                    alert(response.data.message);
                    window.location.reload();
                    // console.log(response.data.message);
                }).
                catch(error => {
                    console.log(error);
                })
            },
            rejectCall: function (url) {
                if (!confirm('Are You Sure You Want To Reject this Call')) {
                    return false;
                }
                axios.get(url, {}).then(response => {
                    alert(response.data.message);
                    window.location.reload();
                    // console.log(response.data.message);
                }).
                catch(error => {
                    console.log(error);
                })
            },
            activateCall: function (url) {
                if (!confirm('Are You Sure You Want To Activate this Call')) {
                    return false;
                }
                axios.get(url, {}).then(response => {
                    alert(response.data.message);
                    window.location.reload();
                    // console.log(response.data.message);
                }).
                catch(error => {
                    console.log(error);
                })
            },
            deactivateCall: function (url) {
                if (!confirm('Are You Sure You Want To Deactivate this Call')) {
                    return false;
                }
                axios.get(url, {}).then(response => {
                    alert(response.data.message);
                    window.location.reload();
                    // console.log(response.data.message);
                }).
                catch(error => {
                    console.log(error);
                })
            },
        }
    })
}