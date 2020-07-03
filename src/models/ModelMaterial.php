<?php
class ModelMaterial extends Model {
    protected static $tableName = 'models_materials';
    protected static $columns = [
        'id', 
        'name_model',
        'type_id'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_model = mb_strtoupper($this->name_model, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_model = mb_strtoupper($this->name_model, 'UTF-8');
        return parent::update();
    }

    public static function getModelsByType($filter, $page = 1) {
            $pg = empty($page) ? 1 : $page;
            // Número de usuários por página
            $perPage = 10;
            // Cálcula o registro inicial para compor a query LIMIT
            $start = ($pg - 1) * $perPage;
    
            // Monta a query para consultar todos usuários na $table que pertencem a $type e ordena pela antiguidade
            $sqlTotal = "SELECT models_materials.id, models_materials.name_model, models_materials.type_id, types_materials.name_type"
            . " FROM " . static::$tableName
            . " INNER JOIN types_materials ON models_materials.type_id = types_materials.id" 
            . " WHERE types_materials.name_type LIKE '%{$filter}%' OR models_materials.name_model LIKE '%{$filter}%'"
            . " ORDER BY types_materials.name_type ASC, models_materials.name_model ASC";

            // Monta o pedaço da query que LIMIT com o registro inicial($start) e o número de resgistro por página($perPage)
            $limit = !empty($filter) ? "" : " LIMIT {$start}, {$perPage}";
            // Monta a query de consulta anterior limitando o número de registro obtidos
            $sqlLimit = $sqlTotal . "{$limit}";
    
            $result = Database::getResultFromQuery($sqlLimit);
            
            // Número total de usuários na $table que pertencem a $type
            $total = mysqli_num_rows(Database::getResultFromQuery($sqlTotal));
            
            // Total de páginas para exibir todos os usuários
            $pageCount = ceil($total / $perPage);
    
            $registries = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $registries[$row['id']] = new ModelMaterial($row);
                }
            }
    
            // Retorna os usuários, o número de páginas para exibir todos os registros e a página atual
            return [
                'models' => $registries,
                'pageCount' => $pageCount,
                'currentPage' => $pg
            ];       
    }

    private function validate() {
        $errors = [];

        if(!$this->name_model) {
            $errors['name_model'] = 'Descrição é um campo abrigatório.';
        }

        if(!$this->type_id) {
            $errors['type_id'] = 'Tipo é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}