<?php
namespace Model\Repository;

use PDOException;
use Service\Session;
use Model\Entity\Rooms;
use InvalidArgumentException;

class RoomsRepository extends BaseRepository
{

// Ne pas utiliser car cela m'oblige de passer par le chemin racine afin d'afficher les images (no recommanded) ######
    // public function addRooms(Rooms $rooms)
    // {
    //     // Traitement de l'image
    //     $imgName = $_FILES["room_imgs"]["name"];
    //     $tmpName = $_FILES["room_imgs"]["tmp_name"];
    //     $destination = $_SERVER["DOCUMENT_ROOT"] . "/leGiteDakote/assets/imgs/chambres/" . $imgName;

    //     // Valider et déplacer le fichier téléchargé
    //     if (move_uploaded_file($tmpName, $destination)) 
    //     {
    //         // L'image a été téléchargée avec succès, procédez à l'insertion dans la base de données
    //         $sql = "INSERT INTO rooms (room_number, price, room_imgs, persons, category) VALUES (:room_number, :price, :room_imgs, :persons, :category)";
    //         $request = $this->dbConnection->prepare($sql);
    //         $request->bindValue(":room_number", $rooms->getRoom_number());
    //         $request->bindValue(":price", $rooms->getPrice());
    //         $request->bindValue(":room_imgs", $imgName); 
    //         // Enregistre le nom du fichier, pas le chemin complet
    //         $request->bindValue(":persons", $rooms->getPersons());
    //         $request->bindValue(":category", $rooms->getCategory());
    //         try 
    //         {
    //             $result = $request->execute();
    //                 if ($result) 
    //                 {
    //                     Session::addMessage("success", "La nouvelle chambre a bien été enregistrée");
    //                     return true;
    //                 } else {
    //                     Session::addMessage("danger", "Erreur : la chambre n'a pas été enregistrée");
    //                     return false;
    //                 }
    //         } catch (\PDOException $exception) 
    //         {
    //             Session::addMessage("danger", "Erreur SQL : " . $exception->getMessage());
    //             return false;
    //         }
    //     } else {
    //         // Il y a eu un problème avec le téléchargement de l'image
    //         Session::addMessage("danger", "Erreur lors du téléchargement de l'image");
    //         return false;
    //     }
    // }
###################################################################################################################    

    // Permet d afficher les images en passant par le repertoire uploads conteant les images car l ancienne methode passe par le chemin racine afin d afficher les images qui est no recommanded!!!!!
    public function insertRooms(Rooms $rooms)
    {
        $sql = "INSERT INTO rooms (room_number, price, room_imgs, persons, category) VALUES (:room_number, :price, :room_imgs, :persons, :category)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":room_number", $rooms->getRoom_number());
        $request->bindValue(":price", $rooms->getPrice());
        $request->bindValue(":room_imgs", $rooms->getRoom_imgs()); 
        // Enregistre le nom du fichier, pas le chemin complet
        $request->bindValue(":persons", $rooms->getPersons());
        $request->bindValue(":category", $rooms->getCategory());
        try 
        {
            $result = $request->execute();
            if ($result) {
            Session::addMessage("success", "La nouvelle chambre a bien été enregistrée");
            return true;
            } else {
            Session::addMessage("danger", "Erreur : la chambre n'a pas été enregistrée");
            return false;
            }
        } catch (\PDOException $exception) 
        {
            Session::addMessage("danger", "Erreur SQL : " . $exception->getMessage());
            return false;
        }
        // Il y a eu un problème avec le téléchargement de l'image
        Session::addMessage("danger", "Erreur lors du téléchargement de l'image");
        return false;
    }
    
    public function findRoomsById($id)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM rooms WHERE id_room = :id_room");
        // Convertir en entier
        // $id = intval($id); 
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false) 
        {
            // Gère l'erreur d'ID invalide
            error_log("Invalid room ID: " . $id);
            return false;
        }
        $request->bindParam(':id_room', $id);
        error_log("SQL Query: " . $request->queryString);
        try 
        {
            if ($request->execute()) 
            {
                if ($request->rowCount() === 1) {
                    $request->setFetchMode(\PDO::FETCH_CLASS,"Model\Entity\Rooms");
                    return $request->fetch();
                } else {
                    return false;
                }
            } else {
                // Log des erreurs
                error_log("SQL Error: " . print_r($request->errorInfo(), true));
                // Retourne false ou déclenche une exception, en fonction de la logique
                return false;
                 // Lance une exception en cas d'échec de l'exécution de la requête
                 throw new \PDOException("Error executing the query.");
            }
        } catch (\PDOException $e) 
        {
            // Gère l'exception (loguer l'erreur, afficher un message, etc.)
            // également renvoye $e->getMessage() pour obtenir le message d'erreur spécifique.
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }

    public function deleteRoomsById($id)
    {
        try 
        {
            // Connexion à la base de données ici 
            $dbConnection = $this->dbConnection;
            // Une nouvelle instance de DetailsRepository
            $detailsRepository = new DetailsRepository($dbConnection); 
    
            $dbConnection->beginTransaction();
            // Supprimer les détails associés à la chambre à supprimer
            $detailsRepository->deleteDetailsByRoomId($id);

            // Ensuite, supprimer la chambre de la table 'rooms'
            $request = $this->dbConnection->prepare("DELETE FROM rooms WHERE id_room = :id_room");
            $request->bindParam(':id_room', $id);
            $success = $request->execute();

            $dbConnection->commit();

            return $success; // La suppression a réussi
        } catch (PDOException $e) 
        {
            $dbConnection->rollBack();
            // Gère les erreurs, par exemple :
            echo "Erreur : " . $e->getMessage();
            return false; // La suppression a échoué
        }
    }

    public function updateRooms($id, Rooms $room)
    {
        try 
        {
            // Connexion à la base de données ici 
            $dbConnection = $this->dbConnection;
            // Une nouvelle instance de DetailsRepository
            $detailsRepository = new DetailsRepository($dbConnection); 
    
            $dbConnection->beginTransaction();
            // Supprimer les détails associés à la chambre à supprimer
            $detailsRepository->updateDetailsByRoomId($id);

            $request = $this->dbConnection->prepare("UPDATE rooms 
                    SET room_number = :room_number, price = :price, room_imgs = :room_imgs,persons = :persons,category = :category,room_state = :room_state
                    WHERE id_room = :id_room");
            // $request = $this->dbConnection->prepare($sql);
            $request->bindValue(":room_number", $room->getRoom_number());
            $request->bindValue(":price", $room->getPrice());
            $request->bindValue(":room_imgs", $room->getRoom_imgs());
            $request->bindValue(":persons", $room->getPersons());
            $request->bindValue(":category", $room->getCategory());
            $request->bindValue(":room_state", $room->getRoom_state());
            $request->bindValue(":id_room", $room->getId_room());
            $success = $request->execute();
            $dbConnection->commit();

            return $success; // La modification a réussi
        } catch (PDOException $e) 
        {
            $dbConnection->rollBack();
            // Gère les erreurs, par exemple :
            echo "Erreur : " . $e->getMessage();
            return false; // La modification à échoué
        }
    }

    public function findRoomsByCategory($category)
    {
        // Valide la valeur de la catégorie par rapport aux valeurs ENUM possibles
        $validCategories = ["classic","piscine"];

        // Vérifiez la valeur de la catégorie
        if (!in_array($category, $validCategories)) 
        {
            // Gérer une catégorie invalide
            throw new InvalidArgumentException("Catégorie invalide");
        }
        $request = $this->dbConnection->prepare("SELECT * FROM rooms WHERE category = :category");
        // Liaison du paramètre nommé à la valeur
        $request->bindParam(':category', $category, \PDO::PARAM_STR);
        // Exécution de la requête
        $request->execute();
        // Récupération des résultats
        $result = $request->fetchAll(\PDO::FETCH_ASSOC);
        // Fermeture de la requête
        $request->closeCursor();
        // Retourne les résultats 
        return $result;
    }

    public function findRoomsByCategoryJson($category)
    {
        $rooms = $this->findRoomsByCategory($category);
        // Convertir le résultat en JSON
        $jsonResult = json_encode($rooms);
        // Vérifie s'il y a une erreur de codage JSON
        if (json_last_error() !== JSON_ERROR_NONE) 
        {
            // Gère l'erreur de codage JSON ici
            return json_encode(['error' => 'Erreur de codage JSON']);
        }
        return $jsonResult;
    }

    public function findAllRooms()
    {
        $request = $this->dbConnection->prepare("SELECT * FROM rooms");
        if ($request->execute()) 
        {
            return $request->fetchAll(\PDO::FETCH_CLASS, "Model\Entity\Rooms");
        } else {
            return null;
        }
    }   

    public function getPrice($id_room)
    {
        $request = $this->dbConnection->prepare("SELECT price FROM rooms WHERE id_room = :id_room");
        $request->bindValue(":id_room", $id_room);
        if ($request->execute()) 
        {
             // Vérifier si la requête a retourné un résultat
            if ($request->rowCount() > 0) 
            {
                // Retourne le prix en tant que résultat de la requête
                return $request->fetchColumn();
            } else {
                return null;
            }
        } else {
            // En cas d'échec de l'exécution de la requête, retourner null par défaut
            return null;
        }
    }   

    public function findRoomDetail($roomId)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM details WHERE room_id = :room_id");
        $request->bindParam(":room_id", $userId, \PDO::PARAM_INT);
        // Affiche le requête SQL pour le débogage
// var_dump($request->queryString);
        if ($request->execute()) 
        {
            $results = $request->fetchAll(\PDO::FETCH_CLASS, "Model\Entity\Details");
            // Affiche les résultats pour le débogage
//   var_dump($results);
              return $results;
        } else {
            return null;
        }
    }

    public function updateRoomById($id, Rooms $room)
    {
        // d_die($id);
        try 
        {
            // Connexion à la base de données ici 
            $dbConnection = $this->dbConnection;
            $dbConnection->beginTransaction();
            // Une nouvelle instance de DetailsRepository
            $detailsRepository = new DetailsRepository($dbConnection); 

            // modifier les détails associés à la chambre à modifier
            $detailsRepository->updateDetailsByRoomId($id);
            // d_die($id);

            // Ensuite, modifier la chambre de la table 'rooms'
            $request = $this->dbConnection->prepare("UPDATE rooms SET room_number = :room_number, price = :price, room_imgs = :room_imgs,persons = :persons,category = :category WHERE id_room = :id_room");
            // Afficher la requête SQL générée pour le débogage
// echo $request->queryString;
            $request->bindParam(":room_number", $room->getRoom_number());
            d_die($request);
            $request->bindParam(":price",$room->getPrice());
            $request->bindParam(":room_imgs", $room->getRoom_imgs()); 
            // Enregistre le nom du fichier, pas le chemin complet
            $request->bindParam(":persons", $room->getPersons());
            $request->bindParam(":category", $room->getCategory());
            $request->bindParam(':id_room', $id);
            $success = $request->execute();
d_die($success);
            $dbConnection->commit();

            return $success; // La modification a réussi
        } catch (PDOException $e) 
        {
            $dbConnection->rollBack();
            // Gère les erreurs, par exemple :
            echo "Erreur : " . $e->getMessage();
            return false; // La modification a échoué
        }
    }

    public function updateRoom(Rooms $rooms)
    {
        $sql = "UPDATE rooms SET room_number = :room_number, price = :price, room_imgs = :room_imgs, persons = :persons, category = :category WHERE id_room = :id_room";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":room_number", $rooms->getRoom_number());
        $request->bindValue(":price", $rooms->getPrice());
        $request->bindValue(":room_imgs", $rooms->getRoom_imgs()); 
        // Enregistre le nom du fichier, pas le chemin complet
        $request->bindValue(":persons", $rooms->getPersons());
        $request->bindValue(":category", $rooms->getCategory());
        // Ajout du paramètre id_room
        $request->bindValue(":id_room", $rooms->getId_room()); 
        // d_die($request);

        try 
        {
            $result = $request->execute();
            if ($result) {
            Session::addMessage("success", "La nouvelle chambre a bien été modifiée");
            return true;
            } else {
            Session::addMessage("danger", "Erreur : la chambre n'a pas été modifiée");
            return false;
            }
        } catch (\PDOException $exception) 
        {
            Session::addMessage("danger", "Erreur SQL : " . $exception->getMessage());
            return false;
        }
        // Il y a eu un problème avec le téléchargement de l'image
        Session::addMessage("danger", "Erreur lors du téléchargement de l'image");
        return false;
}

}