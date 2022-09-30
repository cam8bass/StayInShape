<?php

namespace App\views\viewsTech\ViewsMail;



class ViewsMail
{



  public function mailCreateClub($clubName, $idClub, $clubPermissions, $activationKey)
  {
    $permission = implode(", ", $clubPermissions);
    return  "

        <h1>Confirmation de création d'un nouveau club</h1>
        <p>Suite à votre demande de création de compte pour le club $clubName,les permissions appliquées sont $permission</p>
        <p>Afin de confirmer la création de ce compte veuillez cliquer sur ce lien</p>
        <a class='content__link' href='https://camei8ht.fr/index.php?status=off&action=mailConfirmCreateClub&id=$idClub&key=$activationKey' target='_blank' >Confirmation</a>
     
            ";
  }

  public function mailModifyPermission($newPermissions, $clubName)
  {
    $permission = implode(", ", $newPermissions);
    return "

      <h1>Modification de permission</h1>
      <p>Suite à votre demande de modification de permission pour le club $clubName, les nouvelles permissions disponibles sont $permission .</p>

       ";
  }

  public function changeStatus($clubName)
  {
    return "

      <h1>Modification de statut</h1>
      <p>Une opération de changement de statut vient d'être effectuée sur le compte du club $clubName</p>
    
           ";
  }

  public function deleteClubAccount($clubName)
  {
    return "
    
      <h1>Suppression de compte</h1>
      <p>Le compte du club $clubName, vient d'être supprimé</p>

    ";
  }

  public function changeOwner($clubName)
  {
    return "
    
    <h1>Changement de propriétaire</h1>
    <p>Suite à votre rachat du club $clubName, le changement de propriétaire vient d'être effectué</p>
    
    ";
  }
}
