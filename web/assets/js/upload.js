/* 
 * @Author: Carlos Adrián Domínguez Sárate
 */
mainDropzone=$("main").dropzone({
            url: "{{path('_submit')}}",
            paramName: "uploaded-file",
            params: $.uploadContext,
            previewsContainer: "#upload-preview-zone",
            clickable: "button.upload-handler",
            createImageThumbnails: false,
            init: function () {
                this.on("sending", function (file, xhr, data) {
                    data.append('uploadContext', $.uploadContext);
                    $('#upload-preview-zone').html('');
                    $.mainContent.animate({opacity: 0}, 500, 'swing', function () {
                        $.mainContent.css({display: 'none'});
                    });
                    $.loader.css({display: 'block'});
                });
                this.on("complete", function (file) {
                    $('#upload-preview-zone').html('');
                    $('html, body').animate({scrollTop: 0}, 0);
                    $.mainContent.animate({opacity: 1}, 500, 'swing', function () {
                        $.mainContent.css({display: 'block'});
                        $.loader.css({display: 'none'});
                    });
                });
                this.on("success", function (file,data) {
                    loadPage(actualPage);
                });
            }
        });