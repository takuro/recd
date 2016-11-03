$(function(){

  /* ------------------------------------------------------------------
   * dialog
   * ------------------------------------------------------------------ */

  // login dialog
  var recommendDialog = document.querySelector("#recommend-dialog");
  var showRecommendDialogButton = document.querySelector("#show-recommend-dialog");
  var recommendUserAssignButton = document.querySelector("#assign-recommend-member");

  if (recommendDialog != null) {
    if (!recommendDialog.showModal) {
      dialogPolyfill.registerDialog(recommendDialog);
    }
    showRecommendDialogButton.addEventListener('click', function() {
      recommendDialog.showModal();
    });
    recommendDialog.querySelector('.close').addEventListener('click', function() {
      recommendDialog.close();
    });
    recommendUserAssignButton.addEventListener('click', function() {
      var recommendUser = $("#hidden-recommend-user-name").val();
      $("#recommend-user-area input").val(recommendUser);
      $("#recommend-button").hide();
      $("#recommend-user-area").show();
      recommendDialog.close();
    });
  }

  var sliders = document.querySelectorAll("[type=range]");

  for (var i = 0; i < sliders.length; i++) {
    sliders[i].addEventListener("input", function() {
      var nowScore = this.value;
      console.log(nowScore);
      $(this).closest('.member-rate').find(".now-score").text(nowScore);
    }, false);
  }

});
