<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/28/2017
 * Time: 1:17 PM
 */
?>
@section('style')
    <style>
        .input-hidden {
            position: absolute;
            left: -9999px;
        }

        input[type=checkbox]:checked + label > img {
            border: 1px solid #fff;
            box-shadow: 0 0 3px 3px #090;
        }

        /* Stuff after this is only to make things more pretty */
        input[type=checkbox] + label > img {
            border: 1px dashed #444;
            width: 150px;
            height: 150px;
            transition: 500ms all;
        }

        input[type=checkbox]:checked + label > img {
            transform: rotateZ(-10deg) rotateX(10deg);
        }

        /*
         | //lea.verou.me/css3patterns
         | Because white bgs are boring.
        */
        html {
            background-size: 100% 1.2em;
            background: #fff linear-gradient(
                    90deg,
                    transparent 79px,
                    #abced4 79px,
                    #abced4 81px,
                    transparent 81px
            ),
            linear-gradient(
                    #eee .1em,
                    transparent .1em
            );
        }

    </style>
@stop
<div id="add-media" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Media Library</h4></div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#media-library" aria-controls="media-library" role="tab" data-toggle="tab"
                           aria-expanded="true">
                            <span class="visible-xs"><i class="ti-home"></i></span>
                            <span class="hidden-xs"> Media Library</span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#upload-files" aria-controls="upload-files" role="tab" data-toggle="tab"
                           aria-expanded="false">
                            <span class="visible-xs"><i class="ti-user"></i></span>
                            <span class="hidden-xs">Upload Files</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="media-library">
                        <div class="col-md-9 col-sm-9">
                            <h4 class="box-title m-b-0">Media Files Uploaded</h4>
                            <p class="text-muted m-b-10"> Select any file to keep to article</p>
                            <div class="row">
                                <div id="media-library-slim">
                                    <span v-for="media in mediaLibrary.data">
                                    <input type="checkbox" name="emotion" :id="media.id" class="input-hidden"/>
                                    <label :for="media.id">
                                        <img src="//placekitten.com/150/150" :alt="media.attributes.alt_text"/>
                                    </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <h4 class="box-title m-b-0">Media Details</h4>
                            <p class="text-muted m-b-10">Media Deep details insider</p>
                            <div class="attachment-info">
                                <div class="thumbnail thumbnail-image">
                                    <img src="http://www.treasury.gov.kh/wp-content/uploads/2017/08/13.jpg"
                                         draggable="true" alt="">
                                </div>
                                <div class="details">
                                    <div class="filename">13.jpg</div>
                                    <div class="uploaded">August 7, 2017</div>
                                    <div class="file-size">364 kB</div>
                                    <div class="dimensions">1200 × 799</div>
                                    <a class="edit-attachment"
                                       href="http://www.treasury.gov.kh/wp-admin/post.php?post=2155&amp;action=edit&amp;image-editor"
                                       target="_blank">Edit Image</a>
                                    <button type="button" class="button-link delete-attachment">
                                        Delete Permanently
                                    </button>
                                    <div class="compat-meta">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="upload-files">
                        <div class="col-md-12">
                            <h3 class="box-title m-b-0">Upload Media Files </h3>
                            <p class="text-muted m-b-30"> Drop files anywhere to upload</p>
                            {!! Form::open([ 'route' => [ 'admin.media-library.store' ], 'files' => true, 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                            {!! Form::close() !!}
                            <p class="m-t-20">Maximum upload file size: 100 MB.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger waves-effect waves-light">
                    Insert Media
                </button>
            </div>
        </div>
    </div>
</div>