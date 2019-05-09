$('#hamburger').on("click", function() {
  let element = $('#navbar ul li');
  let button = $('#hamburger');

  if (!button.hasClass("active")) {
    for (let i = 0; i < element.length; i++) {
      element[i].style.display = "list-item";
    }
    button.toggleClass("active");
  } else {
    for (let i = 0; i < element.length; i++) {
      element[i].style.display = "none";
    }
    button.toggleClass("active");
  }
});