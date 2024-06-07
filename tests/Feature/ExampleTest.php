<?php

it('returns a successful response', function () {
    $response = $this->get('/');
    $response->dump();
    $response->assertStatus(200);
});
