<?php

trait ArrayAccess {

    /**
     * 检查数组键是否存在，本例中对象成员就是数组元素、
     * 对一个实现了 ArrayAccess 接口的对象使用 isset() 或 empty() 时，此方法将执行。
     * ~~~
     * $obj = new Obj();
     * var_dump(isset($obj['_data']));
     * ~~~
     * @param mixed $offset 要检查的键名
     * @return boolean
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, get_object_vars($this));
    }

    /**
     * 检查数组键是否存在，在本例中我们把键设置为
     * 对一个实现了 ArrayAccess 接口的对象使用 isset() 或 empty() 时，此方法将执行。
     * ~~~
     * $obj = new Obj();
     * unset($obj['_data']);
     * var_dump(isset($obj['_data']));
     * ~~~
     * @param mixed $offset 要检查的键名
     * @return boolean
     */
    public function offsetUnset($key) {
        if (array_key_exists($key, get_object_vars($this))) {
            unset($this->{$key});
        }
    }

    /**
     * 累了不写了这个是设置数组成员，本例中就是对象属性、
     */
    public function offsetSet($offset, $value) {
        $this->{$offset} = $value;
    }

    public function offsetGet($var) {
        return $this->$var;
    }

}
