/* global $ */

$('#banproof').on('keydown', function () {
  let banProof = $('#banproof').val()
  $('#bansave').prop('disabled', !banProof.startsWith('http'));
})

$('#bansave').on('click', function () {
  let banID = $('#banID').val()
  let banProof = $('#banproof').val()
  let banNotes = $('#bannotes').val()

  if (!banProof.startsWith('http')) {
    return
  }

  $.ajax({
    type: 'POST',
    url: '/admin/ban/' + banID,
    data: {
      banProof,
      banNotes
    },
    success: function () {
      window.location.href = '/admin/banlog'
    }
  })
})
