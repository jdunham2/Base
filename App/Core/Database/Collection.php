<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 12/11/17
 * Time: 8:31 PM
 */

namespace App\Core\Database;


use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

class Collection implements ArrayAccess, Countable, IteratorAggregate
{
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public static function make($items)
    {
        return new static($items);
    }

    public function map($callback)
    {
        return new static(array_map($callback, $this->items));
    }

    public function filter($callback)
    {
        return new static(array_filter($this->items, $callback));
    }

    function reduce($callback)
    {
        $accumulator = [];

        foreach ($this->items as $item) {
            $accumulator = $callback($accumulator, $item);
        }

        return new static($accumulator);
    }

    public function toArray()
    {
        return (array)$this->items ?: array();
    }

    public function contains($key)
    {
        if (func_num_args() == 1) {
            return in_array($key, $this->items) ? $key : false;
        }

        throw new \Exception("Invalid num of params given to Collection::contains method.");
    }

    /**
     * Get a flattened array of the items in the collection.
     *
     * @param  int $depth
     * @return static
     */
    public function flatten($depth = INF)
    {
        return new static(static::flattenArr($this->items, $depth));
    }

    protected static function flattenArr($array, $depth)
    {
        return array_reduce($array, function ($result, $item) use ($depth) {
            $item = $item instanceof Collection ? $item->all() : $item;

            if (!is_array($item)) {
                return array_merge($result, [$item]);
            } elseif ($depth === 1) {
                return array_merge($result, array_values($item));
            } else {
                return array_merge($result, static::flattenArr($item, $depth - 1));
            }
        }, []);
    }

    function flattenWithKeys($array = null)
    {
        $result = array();
        $array = $array ?: $this->items;

        foreach ($array as $key => $value) {
            $array = $array instanceof Collection ? $this->flattenWithKeys($array->items) : $array;

            if (is_array($value)) {
                if (!is_numeric($key))
                    $result[$key] = $result + $this->flattenWithKeys($value);

                $result = $result + $this->flattenWithKeys($value);
            }
            else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Pass the collection to the given callback and return the result.
     *
     * @param  callable $callback
     * @return mixed
     */
    public function pipe(callable $callback)
    {
        return new static($callback($this->items));
    }

    public function pluck($attribute)
    {
        return collect($this->items)->map(function ($item) use ($attribute) {
            return $item[$attribute];
        })->filter(function($items) {
            return !empty($items);
        })->all();
    }

    public function splice($offset, $length)
    {
        return new static(array_splice($this->items, $offset, $length));
    }

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    public function count()
    {
        return count($this->items);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function __get($name)
    {
        return $this->items[$name];
    }

    public function __set($name, $value)
    {
        return $this->items[$name] = $value;
    }
}