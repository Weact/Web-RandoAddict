//Wait page finish loading
let accueil = "Structure/ListeRandonneesAccueil.php"
window.addEventListener("load", function () {
  goTo(accueil);
  goToOnClick(document.getElementsByClassName("goToRando"), "Structure/PageRandonee.php");
  goToOnClick(document.getElementsByClassName("goToMyRando"), "Structure/ListeRandonneesAdminPage.php");
  goToOnClick(document.getElementsByClassName("goToDispRando"), "Structure/ListeRandonneesAccueil.php");
  goToOnClick(document.getElementsByClassName("goToAdmin"), "Structure/PageAdmin.php");
  goToOnClick(document.getElementsByClassName("goToContactFAQ"), "Structure/PageFAQ.php");
});

function goToOnClick(btnArray, page) {
  for(let btn of btnArray) {
    btn.addEventListener("click", ()=>{
      goTo(page)
    });
  }
}

function goTo(page) {
    console.log("Go to " + page);
    $.ajax({
        url: page, success: function (result) {
            $("#main").html(result);
        }
    });
}
