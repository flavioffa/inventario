<?php
class Division extends Model {
    protected static $tableName = 'divisions';
    protected static $columns = [
        'id', 
        'name_division',
        'initials_division',
        'chief_division_id',
        'division_unit_id'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_division = mb_strtoupper($this->name_division, 'UTF-8');
        $this->initials_division = mb_strtoupper($this->initials_division, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_division = mb_strtoupper($this->name_division, 'UTF-8');
        $this->initials_division = mb_strtoupper($this->initials_division, 'UTF-8');
        return parent::update();
    }

    public static function getFullDetails($filter = '', $unit) {
        // Monta a query para consultar todos usuários na $table que pertencem a $type e ordena pela antiguidade
        $sql = "SELECT divisions.*, users.name, users.rank"
        . " FROM " . static::$tableName
        . " INNER JOIN users ON divisions.chief_division_id = users.id"  
        . " WHERE divisions.division_unit_id = {$unit} " . ($filter != '' ? " AND (divisions.name_division LIKE '%{$filter}%' OR users.name LIKE '%{$filter}%' OR divisions.initials_division LIKE '%{$filter}%')" : '')
        . " ORDER BY divisions.name_division ASC";

        $result = Database::getResultFromQuery($sql);

        $registries = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $registries[$row['id']] = new Division($row);
            }
        }

        // Retorna os materiais, o número de páginas para exibir todos os registros e a página atual
        return $registries;        
    }

    private function validate() {
        $errors = [];

        if(!$this->name_division) {
            $errors['name_division'] = 'Nome é um campo abrigatório.';
        }

        if(!$this->initials_division) {
            $errors['initials_division'] = 'Sigla é um campo abrigatório.';
        }

        if(!$this->chief_division_id) {
            $errors['chief_division_id'] = 'Chefe é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

}