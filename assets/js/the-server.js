function showHideRankInfo(elementname) {
  $('.expand').each(function() {
    $(this).hide();
  });
  
  if($('[name="' + elementname + '"] div').css('display') == "none") {
    $('[name="' + elementname + '"] div').show();
  } else {
    $('[name="' + elementname + '"] div').hide();
  }  
}

$("#serverip").on('click', function() {
  $("#serverip").select();
  document.execCommand("copy");
  $('#copyinfo').html("Copied!");  
});