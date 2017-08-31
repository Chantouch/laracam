@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/summernote/dist/summernote.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/dropzone-master/dist/dropzone.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/clockpicker/dist/jquery-clockpicker.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('plugins/jquery-asColorPicker-master/css/asColorPicker.css') !!}" rel="stylesheet">
    <link href="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('plugins/timepicker/bootstrap-timepicker.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('plugins/bootstrap-daterangepicker/daterangepicker.css') !!}" rel="stylesheet">
@stop
@section('content')
    {!! Form::model($post, ['route' => ['admin.article.update', $post->id], 'method' => 'patch', 'files'=> true,'class'=>'form-horizontal']) !!}
    @include('article.fields')
    {!! Form::close() !!}
    @include('article.add-media')
@stop

@section('plugins')
    <script type="text/javascript" src="{!! asset('plugins/multiselect/js/jquery.multi-select.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/custom-select/custom-select.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/jasny-bootstrap.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/summernote/dist/summernote.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/dropzone-master/dist/dropzone.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/post.js') !!}"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="{!! asset('plugins/clockpicker/dist/jquery-clockpicker.min.js') !!}"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{!! asset('plugins/jquery-asColorPicker-master/libs/jquery-asColor.js') !!}"></script>
    <script src="{!! asset('plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js') !!}"></script>
    <script src="{!! asset('plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') !!}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{!! asset('plugins/timepicker/bootstrap-timepicker.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap-daterangepicker/daterangepicker.js') !!}"></script>
@stop

@section('scripts')
    <script>

        let app = new Vue({
            el: '#app',
            data: {
                tag_lists: [],
                api_url: '/api/v1/',
                status: false,
                edit: true,
                article: {
                    status: 'draft',
                    category: {!! isset($post->categories) ? $post->categories->pluck('id') : 0 !!},
                    tags: {!! isset($post->tags) ? $post->tags->pluck('id') : 0 !!},
                },
                images: '',
                categories: [],
                newCat: {
                    'newcategory': '',
                    'parent_cat': ''
                },
                showCat: false,
                formErrors: {},
                item: {
                    category: [1]
                },
                newTag: {
                    'name': ''
                },
                mediaLibrary: {},
                //checkBox: true
                posted_at: {
                    date: '',
                    time: '',
                    now_label: 'Immediately',
                    schedule: '',
                    edit: true,
                    now: ''
                },
                visibility: false,
            },
            created: function () {
                this.tagList();
                this.categoryList();
                //this.getMediaLibrary();
            },
            methods: {
                tagList: function () {
                    let vm = this;
                    vm.$http.get('/api/v1/tag').then((response) => {
                        vm.tag_lists = response.data;
                    })
                },
                categoryList: function () {
                    let vm = this;
                    vm.$http.get('/api/v1/categories').then((response) => {
                        this.categories = response.data;
                    })
                },
                showStatus: function () {
                    let vm = this;
                    vm.status = true;
                    vm.edit = false;
                },
                cancelStatus: function () {
                    let vm = this;
                    vm.status = false;
                    vm.edit = true;
                },
                changeStatus: function () {
                    let vm = this;
                    vm.status = false;
                    vm.edit = true;
                },
                newTags: function () {
                    let vm = this;
                    let input = this.newTag;
                    vm.$http.post('/api/v1/tag', input).then(response => {
                        if (response.data.fail) {
                            vm.formErrors = response.data.errors;
                        } else {
                            this.newTag = {
                                'name': ''
                            };
                            vm.formErrors = '';
                            $.toast({
                                heading: 'Welcome to my Elite admin',
                                text: 'Tag ' + response.data.name + ' added successfully',
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 6
                            });
                            vm.tagList();
                        }
                    })
                },
                newCategory: function () {
                    let vm = this;
                    let input = this.newCat;
                    vm.$http.post('/api/v1/category', input).then(response => {
                        if (response.data.fail) {
                            vm.formErrors = response.data.errors;
                        } else {
                            this.newCat = {
                                'name': '',
                                'parent': ''
                            };
                            vm.formErrors = '';
                            this.showCat = false;
                            alert('Category ' + response.data.name + ' added successfully');
                            vm.categoryList();
                        }
                    })
                },
                showCategory: function () {
                    this.showCat = true;
                },
                previewImage: function (event) {
                    // Reference to the DOM input element
                    let input = event.target;
                    // Ensure that you have a file before attempting to read it
                    if (input.files && input.files[0]) {
                        // create a new FileReader to read this image and convert to base64 format
                        let reader = new FileReader();
                        // Define a callback function to run, when FileReader finishes its job
                        reader.onload = (e) => {
                            // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                            // Read image as base64 and set to imageData
                            this.images = e.target.result
                        };
                        // Start the reader job - read file as a data url (base64 format)
                        reader.readAsDataURL(input.files[0]);
                    }
                },
                removeImage: function () {
                    let vm = this;
                    vm.images = '';
                },
                addMedia: function (e) {
                    e.preventDefault();
                    $('#add-media').modal('show');
                    this.getMediaLibrary();
                },
                getMediaLibrary: function () {
                    let vm = this;
                    vm.$http.get('/api/v1/media-library').then((response) => {
                        vm.mediaLibrary = response.data;
                    });
                },
                checkOnlyOne: function ($id) {
                    console.log($id);
                },
                schedulePost: function () {
                    let vm = this;
                    vm.posted_at.schedule = true;
                    vm.posted_at.edit = false;
                    let now = new Date();
                    let day = ("0" + now.getDate()).slice(-2);
                    let month = ("0" + (now.getMonth() + 1)).slice(-2);
                    vm.posted_at.date = now.getFullYear() + "-" + (month) + "-" + (day);
                    let h = now.getHours();
                    let m = now.getMinutes();
                    if (h < 10) h = '0' + h;
                    if (m < 10) m = '0' + m;
                    vm.posted_at.time = h + ':' + m;
                    vm.posted_at.now = vm.posted_at.date + ' ' + vm.posted_at.time;
                }
            },
            watch: {
                tags: function (nv) {
                    this.tags = nv;
                },
            }
        });
    </script>
    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
    </script>
    <script type="text/javascript">
        $('#media-library-slim').slimScroll({
            color: '#3900ff',
            size: '10px',
            height: '500px',
            railVisible: true,
            alwaysVisible: false
        });

        $(document).ready(function (e) {
            $('.input-hidden').on('change', function () {
                $('.input-hidden').not(this).prop('checked', false);
                console.log(this);
            });
        });
    </script>
@stop