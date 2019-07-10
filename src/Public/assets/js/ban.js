/* global $ */
$('#bansave').on('click', function () {
  let banProof = $('#banproof').val()
  let banNotes = $('#bannotes').val()

  $.ajax({
    type: 'POST',
    url: window.location.pathname,
    data: {
      banProof,
      banNotes
    },
    success: function (response) {
      if (response.success) {
        $('#success').show()
      }
    }
  })
})
