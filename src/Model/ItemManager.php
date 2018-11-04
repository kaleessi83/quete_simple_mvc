<?php
namespace Model;
use Model\Item;
class ItemManager extends AbstractManager
{
    const TABLE = 'item';
    public function __construct($pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }
    public function insert(Item $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
    public function update($id, $title): int
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET title='".$title."' WHERE id=".$id);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
    public function deleteRow(int $delete): int
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=".$delete);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
}
