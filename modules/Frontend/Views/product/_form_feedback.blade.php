<style>
    /** Input file **/
    input[type='file'] {
        display: none;
    }

    .feedback-upload .upload-style + label {
        background-color: #182F43;
        width: 100%;
        padding: 10px 20px;
        color: white;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .feedback-upload .upload-style + label:hover {
        background-color: #9a9a9a;
    }

    .vote-feedback-form .rating {
        float: left;
        border: none;
    }

    .vote-feedback-form .rating:not(:checked) > input {
        position: absolute;
        top: -9999px;
        clip: rect(0, 0, 0, 0);
    }

    .vote-feedback-form .rating:not(:checked) > label {
        float: right;
        padding: 0 .1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 200%;
        line-height: 1.2;
        color: #ddd;
    }

    .vote-feedback-form .rating:not(:checked) > label:before {
        content: '\f005';
        font-family: 'Font Awesome\ 5 Free', serif;
        font-size: 2.5rem;
    }

    .vote-feedback-form .rating > input:checked ~ label {
        font-weight: 900;
        color: gold;
    }

    .vote-feedback-form .rating:not(:checked) > label:hover, .rating:not(:checked) > label:hover ~ label {
        font-weight: 900;
        color: gold;
    }

    .vote-feedback-form .rating > input:checked + label:hover, .rating > input:checked + label:hover ~ label, .rating > input:checked ~ label:hover, .rating > input:checked ~ label:hover ~ label, .rating > label:hover ~ input:checked ~ label {
        color: gold;
    }

    .vote-feedback-form .rating > label:active {
        position: relative;
    }
</style>
<div class="p-3">
    <div class="d-flex justify-content-between align-items-center">
        <h2>{{ trans('Feedback') }}</h2>
        <div class="close-modal p-0">
            <a href="javascript:" class="d-flex" data-bs-dismiss="modal">
                <i class="bi-x"></i>{{trans('關閉')}}
            </a>
        </div>
    </div>
    <div>
        <form action="" method="post" id="feedback-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3 vote-feedback-form">
                <fieldset class="rating">
                    <input type="radio" id="star5" name="vote" value="5"/>
                    <label for="star5"></label>
                    <input type="radio" id="star4" name="vote" value="4"/>
                    <label for="star4"></label>
                    <input type="radio" id="star3" name="vote" value="3"/>
                    <label for="star3"></label>
                    <input type="radio" id="star2" name="vote" value="2"/>
                    <label for="star2"></label>
                    <input type="radio" id="star1" checked name="vote" value="1"/>
                    <label for="star1"></label>
                </fieldset>
            </div>
            <div class="form-group feedback-upload mb-3">
                <input type="file" name="image" id="upload-file" class="upload-style">
                <label id="upload-display" class="d-block" for="upload-file">
                    <i class="fas fa-upload"></i>
                    <span>{{ trans('Choose File...') }}</span>
                </label>
            </div>
            <div class="form-group mb-3">
                <textarea name="content" class="form-control" rows="5"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-main w-100 mb-2 mb-md-0">{{ trans('Send') }}</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-outline-main w-100"
                            data-bs-dismiss="modal">{{ trans('Cancel') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('input[type="file"]').change(function (e) {
        var file_name = e.target.files[0].name;
        $(this).siblings('label#upload-display').html('<i class="fas fa-upload"></i> ' + file_name);
    });
</script>
