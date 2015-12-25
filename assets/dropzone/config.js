Dropzone.options.dropzonersDropzone = {

    uploadMultiple: false,//will not work for multiple uploads
    parallelUploads: 100,
    maxFilesize: 8,
    acceptedFiles: 'image/*',
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 8MB',

    // The setting up of the dropzone
    init:function() {

        this.on("removedfile", function(file) {

            $.ajax({
                type: 'POST',
                url: window.dropzonerDeletePath,
                data: {id: file.serverId, _token: window.csrfToken},
                dataType: 'html',
                success: function(data){
                    var rep = JSON.parse(data);
                    if(rep.code == 200)
                    {
                    }

                }
            });

        } );

    },
    error: function(file, response) {
        if(typeof(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    success: function(file,response) {
        file.serverId = response.filename;
    }
};




