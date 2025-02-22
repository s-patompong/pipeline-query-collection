<?php

namespace Baro\PipelineQueryCollection;

class BitwiseFilter extends BaseFilter
{
    public function __construct($field)
    {
        parent::__construct();
        $this->field = $field;
    }

    protected function apply(): static
    {
        $flag = null;
        foreach ($this->getSearchValue() as $value) {
            $flag ??= intval($value);
            $flag = intval($flag) | intval($value);
        }
        $this->query->whereRaw("{$this->getSearchColumn()} & ? = ?", [$flag, $flag]);
        return $this;
    }
}
