$(function() {

  $('.ticket-assignee').tooltip();

  $('#ticket-tags').tagsinput({ tagClass: 'badge badge-primary' });

  $('#ticket-upload-dropzone').dropzone({
    parallelUploads: 2,
    maxFilesize:     50000,
    filesizeBase:    1000,
    addRemoveLinks:  true
  });

});
