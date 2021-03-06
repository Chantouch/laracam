<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\Role;

class RoleTransformer extends TransformerAbstract
{
    /**
     * Transform a role.
     *
     * @param Role $role
     * @return array
     */
    public function transform(Role $role): array
    {
        return [
            'id' => $role->id,
            'name' => $role->name
        ];
    }
}
