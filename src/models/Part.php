<?php
class Part extends Model {
    protected static $tableName = 'parts';
    protected static $columns = [
        'id', 
        'name_part',
        'division_id'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_part = mb_strtoupper($this->name_part, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_part = mb_strtoupper($this->name_part, 'UTF-8');
        return parent::update();
    }

    public static function getFullDetails($filter = '', $unit, $division) {
        // Monta a query para consultar todos usuários na $table que pertencem a $type e ordena pela antiguidade
        $sql = "SELECT parts.*, divisions.name_division, divisions.initials_division, users.name, users.rank"
        . " FROM " . static::$tableName
        . " INNER JOIN divisions ON parts.division_id = divisions.id"  
        . " INNER JOIN users ON divisions.chief_division_id = users.id"  
        . " WHERE divisions.division_unit_id = {$unit} AND parts.division_id = {$division} " . ($filter != '' ? " AND (parts.name_part LIKE '%{$filter}%' OR divisions.name_division LIKE '%{$filter}%' OR divisions.initials_division LIKE '%{$filter}%')" : '')
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

        if(!$this->name_part) {
            $errors['name_part'] = 'Nome é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}