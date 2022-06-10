<?php

namespace App\Repositories;

class BaseRepository
{
    /**
     * Get Paginated.
     *
     * @param $per_page
     * @param string $active
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginated($per_page, $active = '', $order_by = 'id', $sort = 'asc')
    {
        if ($active) {
            return $this->query()->where('status', $active)
                ->orderBy($order_by, $sort)
                ->paginate($per_page);
        }

        return $this->query()->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return call_user_func(static::MODEL.'::query');
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->query()->count();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }

    /**
     * Find Record based on specific column.
     *
     * @param string $value
     * @param string $column_name
     *
     * @return mixed
     */
    public function getByColumn($value, $column_name = 'id')
    {
        return $this->query()->where($column_name, $value)->first();
    }

    /**
     * Generate drop-down select data with basic IDs.
     *
     * @param string $field_name
     *
     * @return array
     */
    public function getSelectData($field_name = 'name')
    {
        $collection = $this->getAll();

        return call_user_func(static::MODEL.'::getItems', $collection, $field_name);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    public function getActive()
    {
        return $this->query()
            ->active()
            ->latest()
            ->get();
    }

    public function getActivePaginated($per_page)
    {
        return $this->query()
            ->active()
            ->latest()
            ->paginate($per_page);
    }

    public function getTopActive($per_page)
    {
        return $this->query()
            ->active()
            ->latest()
            ->limit($per_page)
            ->get();
    }
}
