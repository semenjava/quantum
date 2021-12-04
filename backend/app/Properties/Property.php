<?php
namespace App\Properties;

use Modules\Auth\Repositories\UserRepository;

class Property extends BaseProperty
{
    protected $property = [];

    public function __construct($data = array())
    {
        if (!empty($data)) {
          $this->setInstaceProperty($data);
        }
    }

    public function getProperty($key = null)
    {
        return empty($this->property[$key]) ? null : $this->property[$key];
    }

    public function setProperty($key, $value)
    {
        return $this->property[$key] = $value;
    }

    public function set($key, $value)
    {
        return $this->setProperty($key, $value);
    }

    public function add($key, $value) {
      if(is_array($value) && is_array($this->get($key))) {
        $arr = array_merge($this->get($key), $value);
        $this->set($key, $arr);
      } else {
        $this->set($key, $value);
      }
    }

    public function has($key)
    {
        return !empty($this->property[$key]);
    }

    public function get($key)
    {
        return $this->getProperty($key);
    }

    public function all()
    {
        return $this->property;
    }

    public function clearAll()
    {
        $this->property = [];
    }

    public function remove($key)
    {
        if(!empty($this->property[$key]))  {
            unset($this->property[$key]);
        }
        return null;
    }

    public function toCollect()
    {
        return collect($this->property);
    }

    public function toArray()
    {
        $property = $this->property;
        if(!empty($property['user']))  {
            unset($property['user']);
        }
        return $property;
    }

    public function user()
    {
        if($this->has('user')) {
            return $this->get('user');
        }
        return null;
    }

    public function posval(string $str) {
        $exps = explode('.', $str);
        if(!empty($exps)) {
            $count = count($exps);
            $val = !empty($this->property[$exps[0]]) ? $this->property[$exps[0]] : null;
            $i = 1;
            while ($i < $count) {
                if(!empty($exps[$i]) && !empty($val[$exps[$i]])) {
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
