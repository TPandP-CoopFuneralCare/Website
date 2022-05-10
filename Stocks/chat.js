// Scrolls down to the last message
$(window).load(function () {
  $("#messages").animate({ scrollTop: $("#messages").scrollHeight }, 1000);
});

// keeps a memory of the ongoing message
function toMemory(categoryID) {
  document.cookie =
    "message" +
    categoryID.toString() +
    "=" +
    document.getElementById("textarea").value +
    ";";
}
