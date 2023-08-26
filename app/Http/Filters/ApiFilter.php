<?php

namespace App\Http\Filters;


class ApiFilter
{
    protected array $safeParms = [];

    protected array $columnMap = [];

    protected array $operatorMap = [];

    public function transform($request): array
    {
        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators)
        {
            $query = $request->$parm;

            if(!$query) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if(isset($query[$operator]))
                {
                    $eloQuery[] = [$column,$this->operatorMap[$operator],$query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
