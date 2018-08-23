var calls = new Vue({
    el: '#offer_actions',
    data: {
        status:'',
        activation:'',
    },
    methods: {
        approveOffer: function (url) {
            if (!confirm('Are You Sure You Want To Approve this Offer')) {
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
        rejectOffer: function (url) {
            if (!confirm('Are You Sure You Want To Reject this Offer')) {
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
        activateOffer: function (url) {
            if (!confirm('Are You Sure You Want To Activate this Offer')) {
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
        deactivateOffer: function (url) {
            if (!confirm('Are You Sure You Want To Deactivate this Offer')) {
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