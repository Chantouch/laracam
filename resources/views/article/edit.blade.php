@extends('layouts.master')
@section('page-css')
    <link href="{!! asset('plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/custom-select/custom-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('plugins/summernote/dist/summernote.css') !!}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    {!! Form::model($post, ['route' => ['admin.article.update', $post->id], 'method' => 'patch', 'files'=> true,'class'=>'form-horizontal']) !!}
    @include('article.fields')
    {!! Form::close() !!}
@stop

@section('plugins')
    <script type="text/javascript" src="{!! asset('plugins/multiselect/js/jquery.multi-select.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/custom-select/custom-select.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/jasny-bootstrap.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('plugins/summernote/dist/summernote.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/script.js') !!}"></script>
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
                    'status': 'draft',
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
                }
            },
            created: function () {
                this.tagList();
                this.categoryList();
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
                        console.log(reader);
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
                }
            },
            watch: {
                tags: function (nv) {
                    this.tags = nv;
                }
            }
        });
    </script>
@stop