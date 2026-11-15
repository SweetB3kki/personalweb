<?php
declare(strict_types=1);
require_once __DIR__ . '/database.php';

abstract class BaseActiveRecord extends Model
{
    protected static string $table;
    protected static array $fields;
    public ?int $id = null;

    public function save(): static
    {
        $fields = static::$fields;
        $values = array_map(fn($field) => $this->{$field}, $fields);
        if ($this->id === null) {
            $columns = implode(', ', $fields);
            $placeholders = implode(', ', array_fill(0, count($fields), '?'));
            $sql = 'INSERT INTO ' . static::$table . " ($columns) VALUES ($placeholders)";
        } else {
            $assignments = implode(', ', array_map(fn($field) => "$field = ?", $fields));
            $sql = 'UPDATE ' . static::$table . " SET $assignments WHERE id = ?";
            $values[] = $this->id;
        }
        Database::connection()->prepare($sql)->execute($values);
        $this->id ??= (int) Database::connection()->lastInsertId();
        return $this;
    }

    public function delete(): bool
    {
        if ($this->id === null) return false;
        Database::connection()->prepare('DELETE FROM ' . static::$table . ' WHERE id = ?')->execute([$this->id]);
        $this->id = null;
        return true;
    }

    public static function find(int $id): ?static
    {
        $query = Database::connection()->prepare('SELECT * FROM ' . static::$table . ' WHERE id = ?');
        $query->execute([$id]);
        $row = $query->fetch();
        return $row ? static::hydrate($row) : null;
    }

    public static function findAll(): array
    {
        return array_map(fn($row) => static::hydrate($row), Database::connection()->query('SELECT * FROM ' . static::$table . ' ORDER BY id DESC')->fetchAll());
    }

    protected static function hydrate(array $row): static
    {
        $record = new static();
        $record->id = (int) $row['id'];
        foreach (static::$fields as $field) $record->{$field} = $row[$field];
        return $record;
    }
}
