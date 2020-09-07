<?php
namespace App\Services;
use Aura\SqlQuery\QueryFactory;
use PDO; 



class Database {
    private $pdo;
    private $queryFactory;    

    function __construct(PDO $pdo, QueryFactory $queryFactory) {
        $this->queryFactory = $queryFactory;
        $this->pdo = $pdo;
    }

    public function all($table) {
        $select = $this->queryFactory->newSelect();

        $select->cols(['*'])
        ->from($table);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllImagesPage($table, $page = 1, $rows = 1) {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*']) 
        ->from($table)
        ->page($page)
        ->setPaging($rows);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function allImagesHome($table, $limit = '') {
        $select = $this->queryFactory->newSelect();

        $select->cols(['*'])
        ->from($table)
        ->limit($limit) 
        ->orderBy(['date DESC']);   

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($table, $id) {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
        ->from($table)  
        ->where('id = :id')
        ->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);    
    }

    function search($table, $data, $page = 1, $rows = 1) {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
        ->from($table)  
        ->where('title LIKE :data')
        ->orWhere('description LIKE :data')
        ->bindValue('data', "%$data%")
        ->page($page)
        ->setPaging($rows);
        
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($table, $data) {
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into($table)             // insert into this table
            ->cols($data);           
        // prepare the statement
        $sth = $this->pdo->prepare($insert->getStatement());
       
        // execute with bound values
        $sth->execute($insert->getBindValues());
       
        // get the last insert ID

        $name = $insert->getLastInsertIdName('id');
        return $this->pdo->lastInsertId($name);
    }

    public function update($table, $id, $data) {
        $update = $this->queryFactory->newUpdate();

        $update
            ->table($table)                  // update this table
            ->cols($data)
            ->where('id = :id')           // AND WHERE these conditions
            ->bindValue('id', $id);   // bind one value to a placeholder

            // prepare the statement
            $sth = $this->pdo->prepare($update->getStatement());

            // execute with bound values
            $sth->execute($update->getBindValues());
    }

    function delete($table, $id) {
        $delete = $this->queryFactory->newDelete();

        $delete
            ->from($table)                   // FROM this table
            ->where('id = :id')           // AND WHERE these conditions
            ->bindValue('id', $id);   // bind one value to a placeholder

        // prepare the statement
        $sth = $this->pdo->prepare($delete->getStatement());

        // execute with bound values
        return $sth->execute($delete->getBindValues());
    }

    function getCount($table, $row, $bindValue) {
        $select = $this->queryFactory->newSelect();
        $select->cols(["*"])
        ->from($table)
        ->where("$row = :$row")
        ->bindValue($row, $bindValue);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return count($sth->fetchAll(PDO::FETCH_ASSOC));  
    }

    function getImagesUser($table, $row, $id, $page = 1, $rows = 1) {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*']) 
        ->from($table)
        ->where("$row = :row")
        ->bindValue("row", $id)
        ->page($page)
        ->setPaging($rows);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC); 
    }

    function checkImageOfUser($table, $row, $zim, $idImg, $idUser) {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*']) 
        ->from($table)
        ->where("$row = :row")
        ->where("$zim = :zim")
        ->bindValues([                  // bind these values to named placeholders
            'row' => $idImg,
            'zim' => $idUser,
        ]);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $rez = $sth->fetchAll(PDO::FETCH_ASSOC);
        return !empty($rez);
       
    }

    function whereAll($table, $row, $bindValue, $limit) {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*']) 
        ->from($table)
        ->where("$row = :$row")
        ->bindValue("$row", $bindValue)
        ->limit($limit)
        ->orderBy(['date DESC']);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC); 
    }




}