<?php

namespace Src\Features\Rating\Models\Policies;

class RatingPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function update($user, $rate)
    {
        return $user->id === $rate->user_id;
    }

    public function delete($user, $rate)
    {
        return $user->id === $rate->user_id;
    }
}
