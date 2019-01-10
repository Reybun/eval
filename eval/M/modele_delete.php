<?php

function rdv_DELETE($id) {
    $bdd = bdd();
    $query = "DELETE FROM `rdv` WHERE `rdv`.`id` = :id
    ;";

    $query_params = array(
        ':id' => $id
        );

    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function photo_DELETE($id) {
    $bdd = bdd();
    $query = "DELETE FROM `photo` WHERE `fiche_consult_id` = :id
    ;";

    $query_params = array(
        ':id' => $id
        );

    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function rdv2_DELETE($id) {
    $bdd = bdd();
    $query = "DELETE FROM `rdv` WHERE `patient_id` = :id
    ;";

    $query_params = array(
        ':id' => $id
        );

    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function ficheconsult_DELETE($id) {
    $bdd = bdd();
    $query = "DELETE FROM `fiche_consult` WHERE id = :id
    ;";

    $query_params = array(
        ':id' => $id
        );

    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function patient_DELETE($id) {
    $bdd = bdd();
    $query = "DELETE FROM `patient` WHERE id = :id
    ;";

    $query_params = array(
        ':id' => $id
        );

    try {
        $stmt = $bdd->prepare($query);
        $stmt->execute($query_params);
    } catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>

