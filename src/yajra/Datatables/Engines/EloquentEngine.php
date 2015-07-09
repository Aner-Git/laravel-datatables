<?php

namespace yajra\Datatables\Engines;

/**
 * Laravel Datatables Eloquent Engine
 *
 * @package  Laravel
 * @category Package
 * @author   Arjay Angeles <aqangeles@gmail.com>
 */

use Illuminate\Database\Eloquent\Builder;
use yajra\Datatables\Contracts\DataTableEngine;

class EloquentEngine extends QueryBuilderEngine implements DataTableEngine
{

    /**
     * @param mixed $model
     */
    public function __construct($model)
    {
        $this->query_type = 'eloquent';
        $this->query      = $model instanceof Builder ? $model : $model->getQuery();
        $this->columns    = $this->query->getQuery()->columns;
        $this->connection = $this->query->getQuery()->getConnection();
        $this->database   = $this->connection->getDriverName();

        if ($this->isDebugging()) {
            $this->connection->enableQueryLog();
        }
    }

}
