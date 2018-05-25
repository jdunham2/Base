<?php
namespace App\Core\Database;

class QueryBuilder
{
	protected $pdo;
	protected $prefix;
    protected $columns;

    public $operators = [
        '=', '<', '>', '<=', '>=', '<>', '!=', '<=>',
        'like', 'like binary', 'not like', 'between', 'ilike',
        '&', '|', '^', '<<', '>>',
        'rlike', 'regexp', 'not regexp',
        '~', '~*', '!~', '!~*', 'similar to',
        'not similar to', 'not ilike', '~~*', '!~~*', "in", "not in"
    ];

    protected $wheres;
    protected $where_values;
    protected $table;
    private $groupBy;
    private $orderBy;
    private $limit;
    private $offset;
    private $debug = false;
    protected $domainClass;

    public function __construct(\PDO $pdo, $prefix = '')
	{
		$this->pdo = $pdo;
		$this->prefix = $prefix;
	}

    public function from($table)
    {
        $this->table = $table;

        return $this;
    }

    public function table($table)
    {
        return $this->from($table);
    }

    public function setDomainClass($class)
    {
        $this->domainClass = $class;
    }
	
	public function all($columns = array('*'))
	{
	    if (!$this->table)
            throw new \Exception('No table to select from');

	    if (!is_array($columns)) {
	        $columns = array($columns);
        }

	    $fields = implode(',', $columns);

		$sql = "select " . $fields . " from " . $this->prefix . $this->table;

		return collect($this->pdo->query($sql)->fetchAll(2));
	}

	public function find($id)
	{
        if (!$this->table)
            throw new \Exception('No table to select from');

		$sql = "SELECT * FROM " . $this->prefix . $this->table ." WHERE id = {$id}";
		return $this->pdo->query($sql)->fetchAll(2);
	}

	public function query($sql, $fetchCode = 2)
	{
	    if (strpos(strtolower($sql), 'select') !== false) {
            return $this->pdo->query($sql)->fetchAll($fetchCode);
        }

        return $this->pdo->query($sql);
	}

	public function count($column = "*")
    {
        if (is_array($column))
            throw new \Exception('Cannot pass array as argument to count()');

        $result = $this->first("count({$column})", 3);

        return $result[0];
    }

    public function select($columns)
    {
        if (func_num_args() > 1) {
            return $this->select(func_get_args());
        }

        if (!is_array($columns)) {
            $columns = [$columns];
        }

        $this->columns = $columns;

        return $this;
    }

    public function groupBy($groupBy)
    {
        $this->groupBy = $groupBy;
        return $this;
    }

    public function orderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

//	public function insert($data)
//	{
//		$sql = sprintf(
//			"INSERT INTO %s (%s) VALUES (%s)",
//			$this->prefix . $this->table,
//			implode(', ', array_keys($data)),
//			":" . implode(', :', array_keys($data))
//			);
//
//
//		try {
//			$stmt = $this->pdo->prepare($sql);
//			$stmt->execute($data);
//
//		}
//		catch (\PDOException $e) {
//			die($e->getMessage());
//		}
//	}

    public function andWhere($column, $operator = null, $value = null)
    {
        return $this->where($column, $operator, $value, 'AND');
    }

    public function orWhere($column, $operator = null, $value = null)
    {
        return $this->where($column, $operator, $value, 'OR');
    }

    public function customWhere($query)
    {
        $this->wheres['custom'] = $query;
        return $this;
    }

    public function whereNotEmpty($column)
    {
        $this->where($column, "!=", "  ");
        return $this;
    }

    public function where($column, $operator = null, $value = null, $boolean = 'AND') {
        if (is_array($column)) {
            return $this->addArrayOfWheres($column, $boolean);
        }
        // Here we will make some assumptions about the operator. If only 2 values are
        // passed to the method, we will assume that the operator is an equals sign
        // and keep going. Otherwise, we'll require the operator to be passed in.
        list($value, $operator) = $this->prepareValueAndOperator(
            $value, $operator, func_num_args() == 2
        );

        // If the given operator is not found in the list of valid operators we will
        // assume that the developer is just short-cutting the '=' operators and
        // we will set the operators to '=' and set the values appropriately.
        if ($this->invalidOperator($operator)) {
            list($value, $operator) = [$operator, '='];
        }

        $type = 'basic';

        $this->wheres[$type][] = ["column" => $column, "operator" => $operator, "value" => $value, "boolean" => $boolean];
        return $this;

    }

    /**
     * Prepare the value and operator for a where clause.
     *
     * @param  string $value
     * @param  string $operator
     * @param  bool $useDefault
     * @return array
     *
     * @throws \Exception
     */
    protected function prepareValueAndOperator($value, $operator, $useDefault = false)
    {
        if ($useDefault) {
            return [$operator, '='];
        } elseif ($this->invalidOperatorAndValue($operator, $value)) {
            throw new \Exception('Illegal operator and value combination.');
        }

        return [$value, $operator];
    }

    /**
     * Determine if the given operator and value combination is legal.
     *
     * Prevents using Null values with invalid operators.
     *
     * @param  string $operator
     * @param  mixed $value
     * @return bool
     */
    protected function invalidOperatorAndValue($operator, $value)
    {
        return is_null($value) && in_array($operator, $this->operators) &&
            !in_array($operator, ['=', '<>', '!=']);
    }

    /**
     * Determine if the given operator is supported.
     *
     * @param  string $operator
     * @return bool
     */
    protected function invalidOperator($operator)
    {
        return !in_array(strtolower($operator), $this->operators, true);
    }


    /**
     * Add an array of where clauses to the query.
     *
     * @param  array $column
     * @param  string $boolean
     * @param  string $method
     * @return $this
     */
    protected function addArrayOfWheres($column, $boolean, $method = 'where')
    {
        foreach ($column as $key => $value) {
            if (is_numeric($key) && is_array($value)) {
                $this->{$method}(...array_values($value));
            } else {
                $this->$method($key, $value, $boolean);
            }
        }

        return $this;
    }

    /**
     * @param array $columns
     * @param string $fetchType
     * @param int $fetchTypeCode
     * @return \App\Core\Database\Collection
     * @throws \Exception
     */
    public function get($columns = array('*'), $fetchType = "fetchAll", $fetchTypeCode = 2)
    {
        if (!$this->table)
            throw new \Exception('No table to select from');

        if (isset($this->columns)) {
            $stmt = $this->preparedStatement();

            return $this->returnObject($stmt->$fetchType($fetchTypeCode));
        }

        if (!is_array($columns)) {
            $columns = array($columns);
        }

        $this->columns = $columns;

        $stmt = $this->preparedStatement();

        return $this->returnObject($stmt->$fetchType($fetchTypeCode));
    }

    public function first($columns = null, $fetchTypeCode = 2)
    {
        if ($columns == null)
            $columns = $this->columns ?: array('*');

        return $this->get($columns, 'fetch', $fetchTypeCode)->all();
    }

    protected function buildWheres()
    {
        if (!$this->wheres) {
            return '';
        }

        $stmt = 'WHERE';

        if (isset($this->wheres['basic'])) {
            $stmt .= $this->addBasicWheres($this->wheres['basic']);
        }

        $stmt = $this->addCustomWhere($stmt);

        return " " . $stmt;
    }

    protected function addBasicWheres($wheres)
    {
        $stmt = ' ';

        foreach ($wheres as $index => $where) {
            if ($index != 0) {
                $stmt .= " {$where['boolean']}";
            }

            $stmt .= " {$where["column"]} {$where["operator"]}";

            if (in_array(strtolower($where['operator']), ['in', 'not in'])) {
                $stmt .= ' (';
                $segments = array_map(function($item) {
                    $this->where_values[] = $item;
                    return '?';
                }, $where['value']);

                $stmt .= implode(',', $segments);
                $stmt .= ")";
            }
            else {
                $stmt .= " ? ";
                $this->where_values[] = $where['value'];
            }
        }

        return $stmt;
    }

    protected function preparedStatement()
    {
        $columns = implode(',', $this->columns);

        $query = "SELECT " . $columns . " FROM " . $this->prefix . $this->table;
        $query .= $this->buildWheres();
        $query .= $this->addGroupBy();
        $query .= $this->addOrderBy();
        $query .= $this->addLimit();
        $query .= $this->addOffset();

        $this->checkDebugEnabled($query);

        $stmt = $this->pdo->prepare($query);

        try {
            $stmt->execute($this->where_values);
        } catch(\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($query, $e);
            }

            error_log($e->getMessage());
        }

        return $stmt;
    }

    public function reset()
    {
        foreach ($this as $key => $value) {
            if (!in_array($key, ['pdo', 'prefix', 'operators', 'debug']))
            $this->$key = null;
        }
    }

    protected function addOrderBy()
    {
        if (!isset($this->orderBy) || empty ($this->orderBy))
            return "";

        return " ORDER BY {$this->orderBy}";
    }

    protected function addGroupBy()
    {
        if (!isset($this->groupBy))
            return "";

        return " GROUP BY {$this->groupBy}";
    }

    protected function addLimit()
    {
        if (!isset($this->limit))
            return "";

        return " LIMIT {$this->limit}";
    }

    protected function addOffset()
    {
        if (!isset($this->offset))
            return "";

        return " OFFSET {$this->offset}";
    }

    protected function addCustomWhere($stmt)
    {
        if (!isset($this->wheres['custom']))
            return $stmt;

        $stmt = trim(strtolower($stmt));
        $custom = trim(strtolower($this->wheres['custom']));

        if ($stmt == 'where' && substr($custom, 0, 3) == "and")
            return substr($custom, 3);

        return $stmt .= " {$custom}";

    }

    public function debug()
    {
        $this->debug = true;

        return $this;
    }

    private function checkDebugEnabled($query)
    {
        if ($this->debug)
            dd("Statement Debug Enabled", $query, $this->where_values);
    }

    protected function returnObject($executed_query)
    {
        $executed_query = $this->buildDomainObject($executed_query);

        return collect($executed_query);
    }

    private function buildDomainObject($executed_query)
    {
        if (isset($executed_query[0]) && is_array($executed_query[0])) {
            foreach ($executed_query as $key => $possible_domain_object) {
                $executed_query[$key] = $this->buildDomainObject($possible_domain_object);
            }

            return $executed_query;
        }

        if ($this->domainClass && $this->columns[0] == "*" && $executed_query) {
            return $domainObject = (new $this->domainClass($executed_query));
        }

        return $executed_query;
    }
}