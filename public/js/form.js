class  Form {
    constructor(data){

        this.originalData = data;

        for(let field in data){
            this[field] = data[field];
        }

        this.errors = new Errors();
        // console.log(this.errors);
    }

    reset(){
        for(let field in this.originalData){
            this[field] = "";
        }

    }

    data(){

        let data  = Object.assign({},this)
        delete data.originalData;
        delete data.errors;

        return data;
    }

    submit(requestType,url){
        axios[requestType](url, this.data()).
        then(this.onSuccess.bind(this))
        .catch(this.onFail.bind(this))
    }

    onSuccess(response){
        var text = `<div class="activity-item"> 
                        <i class="fa fa-flag-checkered" aria-hidden="true"></i> 
                        <div class="activity" style="display:inline; margin-left:15px;"> ${response.data[0]} </div> </div>
                        `;
            this.errors.notification('information', text);
            this.reset();
    }

    onFail(error){
        if(this.errors.objectHasErrors(error.response.data)){
            this.errors.recordError(error.response.data);
        }
    }
}