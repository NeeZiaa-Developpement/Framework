<?php

namespace App\Models;

use NeeZiaa\Database\QueryBuilder;

class HomeModel
{

    public function example(): array
    {
        return (new QueryBuilder())
            ->select()
            ->table('example')
            ->fetchAll();
    }

}