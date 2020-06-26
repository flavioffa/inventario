<?php
class TypeMaterial extends Model {
    protected static $tableName = 'types_materials';
    protected static $columns = [
        'id', 
        'name_type'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_type = mb_strtoupper($this->name_type, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_type = mb_strtoupper($this->name_type, 'UTF-8');
        return parent::update();
    }

    private function validate() {
        $errors = [];

        if(!$this->name_type) {
            $errors['name_type'] = 'Nome é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}