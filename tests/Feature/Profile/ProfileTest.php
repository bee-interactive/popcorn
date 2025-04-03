<?php

use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests gets a 404 if trying to get a inexisting profile', function (): void {
    $this->get('/@user')->assertStatus(404);
});

test('guests can see a user profile that have activated their public profile', function (): void {
    $user = User::factory()->create([
        'public_profile' => true,
    ]);

    $this->get("/@{$user->username}")->assertStatus(200);
});
