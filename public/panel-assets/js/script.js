// Main
var error = new Vue({
    el: '#error',
    data: {
        message: ''
    },
    mounted: function () {
        this.message = '';
    },
    created() {
        this.message = '';
    }
});


// New Slide
if (document.getElementById('new_slide_form')) {
    var new_slide_form = new Vue({
        el: '#new_slide_form',
        data: {
            red_button_title: '',
            transparent_button_title: ''
        },
        methods: {}
    });
}


// Contact Us
Vue.component('modal', {
    template: `<div class="modal fade in bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"
            style="display: block; padding-right: 15px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <slot name="title"></slot>

                </div>
                <div class="modal-body">
                <slot name="message_body"></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click="$emit('close')
                    ">Close</button>
                </div>

            </div>
        </div>
    </div>`,
    data: function () {
        return {}
    }

});

//  Contact Us Messages Admin
if (document.getElementById('contact_message_admin')) {
    var contact_message_admin = new Vue({
        el: '#contact_message_admin',
        data: {
            modal: false,
            title: '',
            message_body: '',
            errors: new Errors(),
            form: new Form(),
            records: false
        },
        methods: {
            getMessage: function (url) {
                axios.get(url, {}).then(response => {
                    this.modal = true;
                    this.title = response.data.message.subject;
                    this.message_body = response.data.message.message;
                }).catch(error => {
                    console.log(error.response.data);
                });
            },
        },
    });
}


//  Sponsers
if (document.getElementById('new_slide_form')) {
    var sponsers = new Vue({
        el: '#sponsers',
        data: {
            message: '',
            sponsers: '{{$sponsers}}'
        },
        methods: {
            deleteSponser(url) {
                if (confirm(' Are You Sure You Want To delete The Sponser ')) {
                    axios.post(url, {}).then(response => {
                            // console.log(response.data.message);
                            error.message = response.data.message;
                            setTimeout(function () {
                                window.location.reload(true);
                            }, 1000)
                        })
                        .catch(error => {
                            console.log(error.response);
                            window.location.reload(false);
                        });
                }
            }
        },
    });
}

//  ideas 
if (document.getElementById('contact_us_ideas')) {
    var contact_us_ideas = new Vue({
        el: '#contact_us_ideas',
        data: {
            title: '',
            message_body: '',
            modal: false
        },
        methods: {
            getIdea(url) {
                axios.get(url, {}).then((response) => {
                        let idea = response.data.idea;
                        this.title = idea.title;
                        this.message_body = idea.description;
                        this.modal = true;

                    })
                    .catch((errors) => {
                        console.log(errors.response);
                    })
            }
        }
    });
}

//  Themes 
if (document.getElementById('contact_us_themes')) {
    var contact_us_ideas = new Vue({
        el: '#contact_us_themes',
        data: {
            title: '',
            message_body: '',
            modal: false
        },
        methods: {
            getIdea(url) {
                axios.get(url, {}).then((response) => {
                        let idea = response.data.idea;
                        this.title = idea.title;
                        this.message_body = idea.description;
                        this.modal = true;

                    })
                    .catch((errors) => {
                        console.log(errors.response);
                    })
            }
        }
    });
}

//  Themes 
if (document.getElementById('contact_us_forums')) {
    var contact_us_ideas = new Vue({
        el: '#contact_us_forums',
        data: {
            title: '',
            message_body: '',
            modal: false
        },
        methods: {
            getForum(url) {
                axios.get(url, {}).then((response) => {
                        let forum = response.data.forum;
                        this.title = forum.title;
                        this.message_body = forum.description;
                        this.modal = true;
                    })
                    .catch((errors) => {
                        console.log(errors.response.data);
                    })
            }
        }
    });
}

$('.add_image').on('click', function (e) {
    e.preventDefault();
    $('.mini_description').before(`<div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="images[]" class="form-control col-md-7 col-xs-12" />
                </div>
            </div>`);
});

$('a.deleteImage').on('click', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var token = $(this).data('token');
    var form = new Form();
    if (confirm('Are You Sure You Want To Delete This Image')) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                '_token': token
            },
            success: function (response) {
                $('.image_' + response.id).slideUp(600);
                var text = `<div class="activity-item"> 
                        <i class="fa fa-flag-checkered" aria-hidden="true"></i> 
                        <div class="activity" style="display:inline; margin-left:15px;"> ${response.message} </div> </div>
                        `;
                form.errors.notification('information', text);
            }
        });
    }
});

$('#category').on('change', function (e) {
    e.preventDefault();
    var id = $(this).val();
    var url = $(this).data('url') + '/' + id;
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            console.log(response);
            $.each(response.posts, function (k, v) {
                console.log(v.postTags);
            })
        }
    })
})

$('.special_skills').on('change', function () {
    $('.skills_details').toggle();
});

$('body .deadline,.to,.from,.selection,body .datepicker').datepicker({
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    toggleActive: true,
    todayBtn: true,
    format: 'yyyy-mm-dd'
});

tinymce.init({
    selector: '.add_tiny',
    height: 250,
    width: 100 + '%',
    theme: 'modern',
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
    image_advtab: true,
    templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        },
        {
            title: 'Test template 2',
            content: 'Test 2'
        }
    ],
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ]
});