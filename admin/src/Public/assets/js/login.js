var timeout = 1;

$('[name="username"]').on('keyup', function() {
  timeout = 1;
})

function updatePicture() {
    let element = $('[name="username"]');
    let dangerString = element.val();

    let result = cleanUsername(dangerString);
    if(result === false) {
      cleanString = "steve";
    } else {
      cleanString = result;
    }

    let imgURL = "https://minotar.net/helm/" + cleanString + "/150";
    $('#profileImg').attr("src", imgURL);
}

function cleanUsername(dangerString) {
  if(dangerString.length < 1 && dangerString.length > 17) {
    return false;
  }

  if(!/^[A-Za-z0-9_]+$/.test(dangerString)) {
    return false;
  }

  return dangerString;
}

setInterval(function() {
  if(timeout != 0) {
    timeout--;
  } else if(timeout == 0) {
    updatePicture();
  }
}, 500);
