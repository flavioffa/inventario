<?php
class Material extends Model {
    protected static $tableName = 'materials';
    protected static $columns = [
        'id', 
        'model_id',
        'type_material_id',
        'manufacturer_id',
        'fk_division_id',
        'part_id',
        'room',
        'origin',
        'number_unit',
        'number_bmp',
        'number_metallic',
        'number_serial',
        'status_id',
        'condition_id',
        'gmm_cautela',
        'obs',
        'qrcode'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->number_bmp = $this->number_bmp ? $this->number_bmp: null; 
        $this->number_metallic = $this->number_metallic ? $this->number_metallic : null; 
        $this->manufacturer_id = $this->manufacturer_id ? $this->manufacturer_id : null; 
        $this->room = $this->room ?? null; 
        $this->gmm_cautela = $this->gmm_cautela ?? null; 
        $this->obs = $this->obs ?? null; 
        $this->origin = mb_strtoupper($this->origin, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->number_bmp = $this->number_bmp ? $this->number_bmp: null; 
        $this->number_metallic = $this->number_metallic ? $this->number_metallic : null; 
        $this->manufacturer_id = $this->manufacturer_id ? $this->manufacturer_id : null; 
        $this->room = $this->room ?? null; 
        $this->gmm_cautela = $this->gmm_cautela ?? null; 
        $this->obs = $this->obs ?? null; 
        $this->origin = mb_strtoupper($this->origin, 'UTF-8');
        return parent::update();
    }

    public static function getMaterialsFullDetails($filter, $typeFilter, $page = null) {
        $pg = empty($page) ? 1 : $page;
        // Número de usuários por página
        $perPage = 9;
        // Cálcula o registro inicial para compor a query LIMIT
        $start = ($pg - 1) * $perPage;
        // Se o tipo de filtro estiver vazio ou nulo, seta como global
        $typeFilter = empty($typeFilter) ? 'global' : $typeFilter;
        // Monta a query para consultar todos usuários na $table que pertencem a $type e ordena pela antiguidade
        $sqlTotal = "SELECT materials.*, types_materials.name_type, models_materials.name_model,
            manufacturers.name_manufacturer, parts.name_part, divisions.name_division,
            divisions.initials_division, status.name_status, status.color_status, conditions.name_condition,
            conditions.color_condition"
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
        $limit = !empty($filter) ? "" : " LIMIT {$start}, {$perPage}";
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

    public static function getMaterialsFullToReports($typeFilter = null, $subFilter, $table = null, $filter = null) {
        // Se o tipo de filtro estiver vazio ou nulo, seta como global
        // $typeFilter = empty($typeFilter) ? 'global' : $typeFilter;
        // $sqlOptions = "SELECT DISTINCT {$typeFilter}_id FROM materials";
        // Monta a query para consultar todos usuários na $table que pertencem a $type e ordena pela antiguidade
        $sql = "SELECT materials.*, types_materials.name_type, models_materials.name_model, manufacturers.name_manufacturer, parts.name_part, divisions.name_division, divisions.initials_division, status.name_status, status.color_status, conditions.name_condition, conditions.color_condition"
        . " FROM " . static::$tableName
        . " INNER JOIN types_materials ON materials.type_material_id = types_materials.id" 
        . " INNER JOIN models_materials ON materials.model_id = models_materials.id" 
        . " LEFT JOIN manufacturers ON materials.manufacturer_id = manufacturers.id" 
        . " LEFT JOIN parts ON materials.part_id = parts.id" 
        . " INNER JOIN divisions ON materials.fk_division_id = divisions.id" 
        . " INNER JOIN status ON materials.status_id = status.id" 
        . " INNER JOIN conditions ON materials.condition_id = conditions.id" 
        . " WHERE " . (!empty($typeFilter) ? "{$table}.{$typeFilter} = '{$subFilter}'" : "1=1")
        . " ORDER BY name_model ASC, number_unit ASC";
        // echo $sql;
        // exit;
        $result = Database::getResultFromQuery($sql);
        
        // Número total de usuários na $table que pertencem a $type
        $total = mysqli_num_rows(Database::getResultFromQuery($sql));

        $registries = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $registries[] = $row;
            }
        }
        // var_dump($registries);
        // exit;

        // Retorna os materiais
        return $registries;
    }

    public static function countTotalMaterialsByDivisions() {
        $sql = 'SELECT materials.fk_division_id, divisions.initials_division, count(materials.amount) AS qtd
            FROM materials 
            INNER JOIN divisions ON materials.fk_division_id = divisions.id 
            GROUP BY fk_division_id';

        $result = Database::getResultFromQuery($sql);

        $registries = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $registries[] = $row;
            }
        }
        // Retorna os materiais
        return $registries;
    }

    public static function countTotalMaterialsByStatus() {
        $sql = 'SELECT materials.status_id, status.name_status, status.color_status, count(materials.amount) AS qtd
            FROM materials 
            INNER JOIN status ON materials.status_id = status.id 
            GROUP BY status_id';

        $result = Database::getResultFromQuery($sql);

        $registries = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $registries[] = $row;
            }
        }
        
        // Retorna os materiais
        return $registries;
    }

    private function validate() {
        $errors = [];

        if(!$this->number_unit) {
            $errors['number_unit'] = 'Nº da etiqueta da unidade é um campo abrigatório.';
        }

        if(!$this->type_material_id) {
            $errors['type_material_id'] = 'Tipo é um campo abrigatório.';
        }

        if(!$this->model_id) {
            $errors['model_id'] = 'Modelo é um campo abrigatório.';
        }

        if(!$this->fk_division_id) {
            $errors['fk_division_id'] = 'Divisão/Seção é um campo abrigatório.';
        }

        if(!$this->part_id) {
            $errors['part_id'] = 'Setor é um campo abrigatório.';
        }

        if(!$this->status_id) {
            $errors['status_id'] = 'Status é um campo abrigatório.';
        }

        if(!$this->condition_id) {
            $errors['condition_id'] = 'Condição é um campo abrigatório.';
        }

        if(!$this->qrcode) {
            addErrorMsg('Faltando nome do QR-Code.');
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

}