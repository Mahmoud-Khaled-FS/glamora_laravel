<?php

it('returns a successful response', function () {
    /** @phpstan-ignore-next-line */
    $response = $this->get('/');

    $response->assertStatus(404);
});
