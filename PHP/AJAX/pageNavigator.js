//Wait page finish loading
let accueil = "Structure/ListeRandonneesAccueil.php"
window.addEventListener("load", function () {
  goTo(accueil);
  goToOnClick(document.getElementsByClassName("goToRando"), "Structure/PageRandonee.php");
  goToOnClick(document.getElementsByClassName("goToMyRando"), "Structure/ListeRandonneesAdminPage.php");
  goToOnClick(document.getElementsByClassName("goToDispRando"), "Structure/ListeRandonneesAccueil.php");
  goToOnClick(document.getElementsByClassName("goToAdmin"), "Structure/PageAdmin.php");
  goToOnClick(document.getElementsByClassName("goToContactFAQ"), "Structure/PageFAQ.php");

  goSearchRandonnee(document.getElementById("researchRandonnee"), document.getElementById("randonneeRecherche"), "Structure/RandonneeCardsGenerator.php");
});

function goToOnClick(btnArray, page) {
  for(let btn of btnArray) {
    btn.addEventListener("click", ()=>{
      goTo(page)
    });
  }
}

function goSearchRandonnee(btn, input, page){
  btn.addEventListener("click", ()=>{
    searchRandonnee(page, input.value);
  })
  input.onkeypress = function(e){
    var key = e.charCode || e.keyCode || 0;
    if(key == 13){
      searchRandonnee(page, input.value);
      e.preventDefault();
    }
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

function goToPost(page, id) {
  console.log("Go to " + page);
  $.post(page,{
        idProg: id
      },
      function(data, status){
          $("#main").html(data);
      }
  );
};

function setIdProg(id) {
  $.post("ajaxmarchestp.php",
  {
    idProg: id
  },
  function(data, status){
    console.log("Data: " + data + "\nStatus: " + status);
  });

};

function searchRandonnee(page, label){
  console.log("Searching randonne in " + page + " with " + label + "...");

  $.post(page, {
    rechercheRandonnee: label
  },
  function(data, status){
    $("#randonneeCardsRow").html(data);
  });

}