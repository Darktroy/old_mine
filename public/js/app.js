// ------------------------------------ Vue Form Object
if (document.getElementById('contact_form')) {
    var ContactForm = new Vue({
        el: '#contact_form',
        data: {
            form: new Form({
                name: '',
                email: '',
                subject: '',
                message: '',
            }),
            url: '',
        },
        methods: {
            submitForm() {
                this.form.submit('post', this.url + 'home/contact_us');
            },

        }
    });

}
// ------------------------------------ jquery
$(document).ready(function () {
    $('.has_sub').on('click', function () {
        $(this).find('.sub_menu').toggleClass('off');
    })

    $('ul.country_sidebar li').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
    })

    $('.special_skills').on('change', function () {
        $('.skills_details').toggle();
    });

    var selectors = 'body .deadline,.to,.from,body .datepicker';
    if ($(selectors).length) {
        $(selectors).datepicker({
            calendarWeeks: true,
            autoclose: true,
            todayHighlight: true,
            toggleActive: true,
            todayBtn: true,
            format: 'yyyy-mm-dd'
        });
    }

    $('.countries_list').on('change', function () {
        var country = $(this).val();
        var url = $(this).data('url') + '/' + country;
        $.ajax({
            url: url,
            tyEe: 'GET',
            success: function (response) {
                console.log(response);
                $('.cities_list').empty().append(`<option> Select City </option>`);
                $.each(response.cities, function (k, v) {
                    $('.cities_list').append(`<option value="${k}">${v}</option>`)
                });
                $('#phone').empty().val(response.country.phone_code);
            }
        })
    });


    // Add more Education
    var edu_count = 1;
    $('.one_education').on('click', function (e) {
        e.preventDefault();
        edu_count++;
        $('.more_education').before(` <hr> <div class="form-group">
                    
                        <div class="col-xs-12 col-md-6">
                            <label for="degree"> Degree * </label>
                            <input type="text" name="edu[${edu_count}][degree]" class="form-control" id="degree_${edu_count}">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="field"> Field </label>
                            <input type="text" name="edu[${edu_count}][field]" class="form-control" id="field_${edu_count}">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="u_i_name"> University/ institute name </label>
                            <input type="text" name="edu[${edu_count}][u_i_name]" class="form-control" id="u_i_name_${edu_count}">
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <label for="obtained_year"> Obtained year </label>
                            <div class=" input-group date">
                                <input type="date" name="edu[${edu_count}][obtained_year]"  class=" form-control">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                            </div>
                        </div>
                        
                    </div>`)
    })

    //  Add More Work experiance 
    var work_count = 1;
    $('.one_work').on('click', function (e) {
        e.preventDefault();
        work_count++;
        $('.more_work').before(`<hr> <div class="form-group">
                        <div class="col-xs-12 col-md-4">
                            <label for="position"> Position </label>
                            <input type="text" name="work[${work_count}][position]" class="form-control" id="position_${work_count}">
                        </div>

                        <div class="col-xs-12 col-md-4">
                            <label for="company"> Company Name </label>
                            <input type="text" name="work[${work_count}][company]" class="form-control" id="company_${work_count}">
                        </div>

                        <div class="col-xs-12 col-md-4">
                            <label for="work_country"> Work Country </label>
                            <input type="text" name="work[${work_count}][work_country]" class="form-control" id="work_country_${work_count}">
                        </div>

                        <div class="col-xs-12 col-md-4">
                            <label for="work_city"> Work City </label>
                            <input type="text" name="work[${work_count}][work_city]" class="form-control" id="work_city_${work_count}">
                        </div>

                        <div class="col-xs-12 col-md-4">
                            <label for="from"> From </label>
                            <div class=" input-group date">
                                <input type="date" name="work[${work_count}][from]"  class=" form-control">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-4">
                            <label for="to"> To </label>
                            <div class=" input-group date">
                                <input type="date" name="work[${work_count}][to]"  class="form-control">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                            </div>
                        </div>

                        
                        <div class="col-xs-12">
                            <label for="job_description"> Description  </label>
                            <textarea name="work[${work_count}][job_description]" id="job_description_${work_count}" rows="5"></textarea>
                        </div>
                    </div>`)
    })

    // Add More Lang Count
    var lang_count = 1;
    $('.one_lang').on('click', function (e) {
        e.preventDefault();
        lang_count++;
        $('.more_langs').before(`<hr> <div class="form-group">
                        <div class="col-xs-12 col-md-4">
                            <label for="lang_name"> Lang Name </label>
                            <input type="text" name="lang[${lang_count}][lang_name]" class="form-control" id="lang_name">
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <label for="level"> Level </label>
                            <div class="form-input">
                                <label class="radio-inline">
                                    <input type="radio" name="lang[${lang_count}][level]" value="b"> Beginner
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="lang[${lang_count}][level]" value="i" >Intermediate
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="lang[${lang_count}][level]" value="a" > Advanced
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="lang[${lang_count}][level]" value="f/n" > Fluent native
                                </label>
                            </div>
                        </div>
                    </div>`);
    });

    $(function () {
        // Initialize responsive functionality
        $('.table-togglable').footable();
    });

    $('a.dropdown-toggle').on('click',function (e) {
        e.preventDefault();
        $(this).next('ul.dropdown-menu').slideToggle();

    })

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

    $('select').select2();
    $('input.timepicker').timepicker({});

    $('.invite_friend_form').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            type:'post',
            data:$(this).serialize(),
            success:function (response) {
                $('#invite_friend').modal('hide');
                $('#invite_friend').on('hide.bs.modal', function() {
                    alert(response.message)
                });
            }
        })
    })

});