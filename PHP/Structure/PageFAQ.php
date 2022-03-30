<!--

/*******************************************************************************\
* Fichier       : /PHP/Structure/PageFAQ.php
*
* Description   : Page de type FAQ du site / et les contacts
*
* Créateur      : GALATI Gaetan
\*******************************************************************************/
/*******************************************************************************\
* 30-03-2022   : Création de la page
\*******************************************************************************/

-->
<section>
  <h3 class="text-center mb-4 pb-2 text-primary fw-bold" id="Apropos">A propos de nous</h3>
    <p>Lorem ipsum dolor sit amet. Et mollitia eaque sed ducimus fuga qui molestiae aspernatur id maiores asperiores ut sint rerum in nesciunt corrupti </p>  

  <h3 class="text-center mb-4 pb-2 text-primary fw-bold" id="#FAQ">FAQ</h3>
  <p class="text-center mb-5">
      Voici une sélection des questions les plus fréquemment posées !    
   </p>

  <div class="row">

    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-primary"><i class="fas fa-user text-primary pe-2"></i> Comment rejoindre une randonnée ? 
      </h6>
      <p>
          Pour rejoindre une randonnée, il suffit de se rendre sur la page <a style="text-decoration: none;" href="Accueil.php" class="link-primary" >d'accueil</a> , après avoir créé un compte, vous trouverez une liste des randonnées disponibles, cliquez sur le bouton pour obtenir une vue plus approfondie de l'expédition.
          Sur la page de l'expédition, vous trouverez un bouton pour la rejoindre en tant que randonneur (ou en tant que guide si vous êtes guide).
      </p>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-primary"><i class="fas fa-rocket text-primary pe-2"></i>Une randonnée peut-elle être annulée ? 
      </h6>
      <p>
          Malheuresement <strong>OUI</strong> Cependant, vous serez toujours informé 3 jours à l'avance du statut de votre randonnée par e-mail. Une randonnée ne peut avoir lieu que s'il y a un guide et suffisamment de randonneurs. 
          Bien entendu, si une randonnée est annulée, vous serez entièrement remboursé.
    </p>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-primary"><i class="fas fa-home text-primary pe-2"></i> Comment devenir guide ? 
      </h6>
      <p>Si vous voulez devenir guide, vous devrez contacter les administrateurs du site, mais d'abord vous devez avoir plusieurs randonnées de divers niveaux à votre actif, les administrateurs traiteront ensuite votre dossier. </p>
    </div>
  </div>
    <p class="text-center mb-5">
      Une autre question ? Si vous ne trouvez pas votre bonheur ici n'hésitez pas à utiliser la rubrique <a style="text-decoration: none;" href="#Contact" class="link-primary" >contact</a>     
   </p>
    
<div style="display: flex;
justify-content : center;" >
<div class="accordion, w-50" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Question #1
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body" style="color: black" >Lorem ipsum dolor sit amet. Et mollitia eaque sed ducimus fuga qui molestiae aspernatur id maiores asperiores ut sint rerum in nesciunt corrupti hic numquam quas. Est expedita omnis et assumenda cumque qui quod ipsam qui optio omnis. Qui enim voluptatibus aut architecto alias sed nobis ullam non minima optio vel accusantium ratione. Ut quia inventore est vitae sint est saepe atque et animi unde..</div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Question #2
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body" style="color: black">Sed natus perferendis hic perspiciatis reprehenderit sed nisi quia sit maiores sapiente! Non quaerat velit eos voluptas quis ex reprehenderit nihil est velit quisquam et corporis rerum qui explicabo veniam 33 perferendis ullam. Non voluptate distinctio ut iure modi At laudantium corporis aut facere Quis ut totam delectus.</div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Question #3
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body" style="color: black">Eum sint maiores ex odio tempora est porro aperiam qui culpa quaerat in illum autem. At vitae amet qui numquam doloribus ut delectus repellat sed harum libero qui rerum sapiente. In molestiae internos sit harum enim qui dolor accusamus.</div>
    </div>
  </div>

</div>
</div>
    <h3 class="text-center mb-4 pb-2 text-primary fw-bold" style="padding-top: 20px" id="Contact">Nous contacter</h3>
    <p class="text-center mb-5">
      Aucune des questions ci-dessus ne répond à votre demande ? Alors contactez-nous  !
    </p>

<div  >
<form style="justify-content: center; flex: auto; padding-left: 25%; padding-right: 25%" >
  <div class="form-group">
    <label for="exampleFormControlInput1">Adresse e-mail</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Pourquoi nous contacter ?</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Une question sur le site / les randonnées</option>
      <option>Une demande de rembousement</option>
      <option>Une plainte concernant un guide</option>
      <option>Une proposition de randonnée</option>
      <option>Une autre raison</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Votre Message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary" style="margin: 2%">Envoyer</button>

</form>
</div>
</section>

