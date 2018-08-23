class Errors {
    constructor() {
        this.errors = {};
        // this.test = test
    }

    recordError(error) {
        this.errors = error;
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    getError(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    clearError(field) {
        if(field){
            delete this.errors[field];
            return;
        }else{
            this.errors = {};            
        }
    }

    notification(type, text) {
        var n = noty({
            text: text,
            type: type,
            dismissQueue: true,
            progressBar: true,
            timeout: 5000,
            layout: 'topRight',
            closeWith: ['click'],
            theme: 'relax',
            maxVisible: 10,
            animation: {
                open: 'animated bounceInRight',
                close: 'animated bounceOutRight',
                easing: 'swing',
                speed: 500
            }
        });
        return n;
    }

    objectHasErrors(obj){
        return Object.keys(obj).length > 0;
    }
}