$(function () {
  var validImgTypes = IMG_TYPES;
  var imgNameLength = IMG_LENGTH;
  var maxImgSize = IMG_SIZE;

  /** upload tmp image file */
  $('#image_input').change(function () {
    console.log("sssssss");
    var file = $(this).prop("files")[0];
    console.log(file);
      $('#image_delete').show();
      if (validateImageFile(file)) {
          requestByAjax(file);
      } else {
          return false;
      }
  });

  /** delete tmp image file */
  $("#image_delete").on('click', function() {
      let fileName = $("input[name='upload_file_path']").val();
      doTempFileDelete(fileName);
  });

  /** upload image to tmp folder via ajax */
  function requestByAjax(file) {
      let fileName = file.name;
      $('#image-error-box').text('');
      var data = new FormData();
      data.append('file', file);
    data.append('_token', $('meta[name="csrf-token"]').attr("content"));
      $.ajax({
          url: URL_UPLOAD_IMG,
          data: data,
          type: 'POST',
          processData: false,
          contentType: false,
        success: function (data, status, jqXHR) {
              $("input[name='upload_file_path']").val(data.path);
              $("input[name='image_url']").val(data.url);
              $("input[name='image']").val(fileName);
              $("#image_displayer").attr('src', data.url);
              $('.image-delete-btn').removeAttr('hidden');
          },
          error: function (jqXHR, status, error) {
              $.each(jqXHR.responseJSON, function (key, val) {
                  $("#image-error-box").text(val);
                  return false;
              });
              return false;
          }
      });
  }

  /** check image file name, file extension and size */
  function validateImageFile(image, maxImgNameLength = imgNameLength, validFileSize = maxImgSize, errorBoxElement = '#image-error-box') {
      let size = image.size
      let fileName = image.name;
      let idxDot = fileName.lastIndexOf(".") + 1;
      let extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
      if (fileName.length > maxImgNameLength) {
          $(errorBoxElement).text('The image name must not be greater than 100.');
          return false;
      } else if (!validImgTypes.includes(extFile)) {
          $(errorBoxElement).text('Please select an image file.');
          return false;
      } else if (size > validFileSize) {
          $(errorBoxElement).text('Please select a file that is 5MB or less.');
          return false;
      }
      return true;
  }

  /** temp file delete */
  function doTempFileDelete(fileName) {
      removeTempFile(fileName, function() {
          $('#image-error-box').text('');
          $("input[name='image_url'], input[name='upload_file_path'], input[name='image_name'], input[name='image']").val("");
          $("#image_displayer").attr('src', "/img/no-image-icon.png");
          $('.image-delete-btn').attr('hidden', true);
      });
  }

  /**remove temp file from storage via ajax */
  function removeTempFile(fileName, action_done) {
      if (fileName.length != 0) {
          $.ajax({
              url: TMP_FILE_DELETE,
              data: {
                  '_token': $('meta[name="csrf-token"]').attr("content"),
                  'tmp_file_name': fileName,
              },
              type: 'POST',
          }).done(action_done);
      } else {
          action_done();
      }
  }
});
