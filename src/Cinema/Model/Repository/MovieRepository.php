<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 17:18
 */

namespace Cinema\Model\Repository;


use Cinema\DBConnection\MyConnection;
use Exception;
use PDO;

class MovieRepository implements CRUDInterface
{
    /**connection to database
     * @var null|PDO
     */
    private $pdo;

    /**
     * MovieRepository constructor.
     */
    public function __construct()
    {
        $connection=new MyConnection();
        $this->pdo=$connection->getPDO();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
    }

    /**
     * @param array $json
     * @throws Exception
     */
    public function add(array $json)
    {

        $appar_year = $json['appar_year'];
        $cast = $json['cast'];
        $duration = $json['duration'];
        $jsoner = $json['jsoner'];
        $linkImdb = $json['linkImdb'];
        $title = $json['title'];

        $genres = $json['genres'];
        $genres = explode(',', $genres);

        $statement = "INSERT INTO Movie(`title`,`appar_year`,`cast`,`duration`,`jsoner`,`linkImdb`)
                            VALUES (:title , :appar_year , :cast , :duration , :jsoner , :linkImdb)";

        $this->pdo->beginTransaction();

        $sstmt = $this->pdo->prepare($statement);

        $sstmt->bindValue('title', $title);
        $sstmt->bindValue('appar_year', $appar_year);
        $sstmt->bindValue('cast', $cast);
        $sstmt->bindValue('duration', $duration);
        $sstmt->bindValue('jsoner', $jsoner);
        $sstmt->bindValue('linkImdb', $linkImdb);

        $sstmt->execute();
        /*
         * for every genre , it is searched in the Genre table
         * if it is not found ,then the transaction is not commited , it is rolled back
         * if it is found , it is added in the GenreMovies table along side with the movie id
         */
        for ($i = 0; $i < count($genres); $i++) {
            $genres[$i] = intval($genres[$i]);
            $sql = "SELECT * FROM Genre WHERE deleted=0 AND ID={$this->pdo->quote($genres[$i])}";
            $stmtt = $this->pdo->query($sql);
            $stmtt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmtt->fetchAll();
            if (count($result) > 0) {
                //found so we update the GenreMovies table
                $statement = "INSERT INTO GenreMovies(`id_movie`,`id_genre`)
                        VALUES (:id_movie, :id_genre)";
                $stmt = $this->pdo->prepare($statement);
                $sql = "SELECT * FROM Movie WHERE deleted=0 AND `title`={$this->pdo->quote($title)}";
                $stmtt = $this->pdo->query($sql);
                // Set to fetch rows data as associative array
                $stmtt->setFetchMode(PDO::FETCH_ASSOC);
                // Fetch all
                $resultt = $stmtt->fetchAll();
                $stmt->bindValue('id_movie', $resultt[0]['ID']);
                $stmt->bindValue('id_genre', $genres[$i]);
                $stmt->execute();

            } else {
                $this->pdo->RollBack();
                throw new Exception ("the genre with that id does not exist");
            }
        }
        $this->pdo->commit();
    }

    /**
     * @param $json
     */
    public function delete($json)
    {
        $id=(int)$json['id'];
        $sql = "UPDATE Movie SET `deleted` = 1 WHERE `ID` = (:id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();
    }

    /**
     * @param array $json
     * @throws Exception
     */
    public function update(array $json)
    {
        $id = (int)$json['id'];
        $appar_year = $json['appar_year'];
        $cast = $json['cast'];
        $duration = $json['duration'];
        $jsoner = $json['jsoner'];
        $linkImdb = $json['linkImdb'];
        $title = $json['title'];

        $genres = $json['genres'];
        $genres = explode(',', $genres);

        $statement = "UPDATE Movie SET `title` = (:title) , `appar_year` = (:appar_year) , `cast` = (:cast) ,
                                    `duration` = (:duration) , `jsoner`= (:jsoner) , `linkImdb` = (:linkImdb)
                                      WHERE `ID` = (:id)";
        $this->pdo->beginTransaction();

        $sstmt = $this->pdo->prepare($statement);
        $sstmt->bindValue('id', $id);
        $sstmt->bindValue('title', $title);
        $sstmt->bindValue('appar_year', $appar_year);
        $sstmt->bindValue('cast', $cast);
        $sstmt->bindValue('duration', $duration);
        $sstmt->bindValue('jsoner', $jsoner);
        $sstmt->bindValue('linkImdb', $linkImdb);

        $sstmt->execute();
        /*
        * for every genre , it is searched in the Genre table
        * if it is not found ,then the transaction is not commited , it is rolled back
        * if it is found , it is added in the GenreMovies table along side with the movie id
        */
        for ($i = 0; $i < count($genres); $i++) {
            $genres[$i] = intval($genres[$i]);
            $sql = "SELECT * FROM Genre WHERE deleted=0 AND ID={$this->pdo->quote($genres[$i])}";
            $stmtt = $this->pdo->query($sql);
            $stmtt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmtt->fetchAll();
            if (count($result) > 0) {
                //found so we update the GenreMovies table
                $statement = "INSERT INTO GenreMovies(`id_movie`,`id_genre`)
                        VALUES (:id_movie, :id_genre)";
                $stmt = $this->pdo->prepare($statement);
                $sql = "SELECT * FROM Movie WHERE deleted=0 AND `title`={$this->pdo->quote($title)}";
                $stmtt = $this->pdo->query($sql);
                // Set to fetch rows data as associative array
                $stmtt->setFetchMode(PDO::FETCH_ASSOC);
                // Fetch all
                $resultt = $stmtt->fetchAll();
                $stmt->bindValue('id_movie', $resultt[0]['ID']);
                $stmt->bindValue('id_genre', $genres[$i]);
                $stmt->execute();


            } else {
                $this->pdo->RollBack();
                throw new Exception ("the genre with that id does not exist");
            }
        }
        $this->pdo->commit();

    }

    /**
     * @param $json
     * @return string
     */
    public function getAll($json)
    {

            $del = $json['id'];


        if (empty($del)) {

            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

            $sql = "SELECT * FROM Movie WHERE deleted=0";
            $stmt = $this->pdo->query($sql);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;
        }
        else{
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

            $sql = "SELECT * FROM Movie WHERE deleted=0 AND ID=$del";
            $stmt = $this->pdo->query($sql);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;
        }
    }

}