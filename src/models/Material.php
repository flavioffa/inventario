<?php
class Material extends Model {
    protected static $tableName = 'materials';
    protected static $columns = [
        'id', 
        'model_id',
        'type_material_id',
        'manufacturer_id',
        'part_id',
        'room',
        'origin',
        'number_unit',
        'number_bmp',
        'number_metallic',
        'number_serial',
        'status',
        'gmm_cautela',
        'obs',
        'qrcode'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->origin = mb_strtoupper($this->origin, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->origin = mb_strtoupper($this->origin, 'UTF-8');
        return parent::update();
    }

    public static function getMaterialsFullDetails($filter, $typeFilter, $page) {
        $pg = empty($page) ? 1 : $page;
        // Número de usuários por página
        $perPage = 10;
        // Cálcula o registro inicial para compor a query LIMIT
        $start = ($pg - 1) * $perPage;
        // Se o tipo de filtro estiver vazio ou nulo, seta como global
        $typeFilter = empty($typeFilter) ? 'global' : $typeFilter;
        // Monta a query para consultar todos usuários na $table que pertencem a $type e ordena pela antiguidade
        $sqlTotal = "SELECT materials.*, types_materials.name_type, models_materials.name_model, manufacturers.name_manufacturer, parts.name_part, divisions.name_division, divisions.initials_division, status.name_status, status.color_status, conditions.name_condition, conditions.color_condition"
        . " FROM " . static::$tableName
        . " INNER JOIN types_materials ON materials.type_material_id = types_materials.id" 
        . " INNER JOIN models_materials ON materials.model_id = models_materials.id" 
        . " LEFT JOIN manufacturers ON materials.manufacturer_id = manufacturers.id" 
        . " LEFT JOIN parts ON materials.part_id = parts.id" 
        . " INNER JOIN divisions ON materials.fk_division_id = divisions.id" 
        . " INNER JOIN status ON materials.status_id = status.id" 
        . " INNER JOIN conditions ON materials.condition_id = conditions.id" 
        . " WHERE " . ($typeFilter == 'global' ? "types_materials.name_type LIKE '%{$filter}%' OR models_materials.name_model LIKE '%{$filter}%' OR manufacturers.name_manufacturer LIKE '%{$filter}%' OR parts.name_part LIKE '%{$filter}%' OR divisions.initials_division LIKE '%{$filter}%' OR status.name_status LIKE '%{$filter}%' OR conditions.name_condition LIKE '%{$filter}%'" : "materials.{$typeFilter} LIKE '%{$filter}%'")
        . " ORDER BY ".  ($typeFilter == 'global' ? "materials.number_unit ASC" : "materials.{$typeFilter} ASC");

        // Monta o pedaço da query que LIMIT com o registro inicial($start) e o número de resgistro por página($perPage)
        $limit = empty($page) ? "" : " LIMIT {$start}, {$perPage}";
        // Monta a query de consulta anterior limitando o número de registro obtidos
        $sqlLimit = $sqlTotal . "{$limit}";

        $result = Database::getResultFromQuery($sqlLimit);
        
        // Número total de usuários na $table que pertencem a $type
        $total = mysqli_num_rows(Database::getResultFromQuery($sqlTotal));
        
        // Total de páginas para exibir todos os usuários
        $pageCount = intval(ceil($total / $perPage));

        $registries = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $registries[$row['id']] = new Material($row);
            }
        }

        // Retorna os materiais, o número de páginas para exibir todos os registros e a página atual
        return [
            'materials' => $registries,
            'pageCount' => $pageCount,
            'currentPage' => $pg,
            'total' => $total
        ]; 
    }

    private function validate() {
        $errors = [];

        if(!$this->name_unit) {
            $errors['name_unit'] = 'Nome é um campo abrigatório.';
        }

        if(!$this->initials_unit) {
            $errors['initials_unit'] = 'Sigla é um campo abrigatório.';
        }

        if(!$this->chief_id) {
            $errors['chief_id'] = 'Comandante é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

}