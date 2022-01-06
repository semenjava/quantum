<?php

namespace App\Properties;

use Modules\Auth\Repositories\UserRepository;

class Property extends BaseProperty
{
    /**
     * @var array
     */
    protected $property = [];

    /**
     * @param $data
     */
    public function __construct($data = array())
    {
        if (!empty($data)) {
            $this->setInstaceProperty($data);
        }
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getProperty($key = null)
    {
        return empty($this->property[$key]) ? null : $this->property[$key];
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setProperty($key, $value)
    {
        return $this->property[$key] = $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return $this->setProperty($key, $value);
    }

    /**
     * @param $key
     * @return string
     */
    public function getUcfirst($key)
    {
        return ucfirst($this->property[$key]);
    }

    /**
     * @param $key
     * @return string
     */
    public function getLcfirst($key)
    {
        return lcfirst($this->property[$key]);
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function add($key, $value)
    {
        if (is_array($value) && is_array($this->get($key))) {
            $arr = array_merge($this->get($key), $value);
            $this->set($key, $arr);
        } else {
            $this->set($key, $value);
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return !empty($this->property[$key]);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->getProperty($key);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->property;
    }

    /**
     * @return void
     */
    public function clearAll()
    {
        $this->property = [];
    }

    /**
     * @param $key
     * @return null
     */
    public function remove($key)
    {
        if (!empty($this->property[$key])) {
            unset($this->property[$key]);
        }
        return null;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function toCollect()
    {
        return collect($this->property);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $property = $this->property;
        if (!empty($property['user'])) {
            unset($property['user']);
        }
        return $property;
    }

    public function toJson()
    {
        return json_encode($this->property);
    }

    public function getDecodeJson($key)
    {
        return json_decode($this->property[$key]);
    }

    /**
     * @return mixed|null
     */
    public function user()
    {
        if ($this->has('user')) {
            return $this->get('user');
        }
        return null;
    }

    /**
     * @param string $str
     * @return mixed|null
     */
    public function posval(string $str)
    {
        $exps = explode('.', $str);
        if (!empty($exps)) {
            $count = count($exps);
            $val = !empty($this->property[$exps[0]]) ? $this->property[$exps[0]] : null;
            $i = 1;
            while ($i < $count) {
                if (!empty($exps[$i]) && !empty($val[$exps[$i]])) {
                    $val = $val[$exps[$i]];
                } else {
                    $val = null;
                }
                $i ++;
            }
        }
        return $val;
    }
}
