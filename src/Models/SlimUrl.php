<?php

namespace D0ggy\LaraSlimUrl\Models;

use Illuminate\Database\Eloquent\Model;

class SlimUrl extends Model
{
    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        $this->setTable(config('slim_url.database.table'));
        parent::__construct($attributes);
    }
}
