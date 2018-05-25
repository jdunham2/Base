<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/16/18
 * Time: 10:28 PM
 */

namespace Domain;


use App\Core\Database\Collection;

abstract class Repository extends Collection implements HasDomainKnowledge
{
    public $raw;
    protected $items;

    public function __construct($db_results)
    {
        $this->raw = $this->items = $db_results;

        if (is_object($db_results)) {
            $this->raw = $this->items = $db_results->all();
        }

        $this->addDomainKnowledge();
    }
}