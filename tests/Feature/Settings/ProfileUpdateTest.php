<?php

use App\Livewire\Settings\Profile;
use App\Models\User;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

pest()->group('profile');

test('profile page is displayed', function (): void {
    $this->actingAs($user = User::factory()->create());

    $this->get('/settings/profile')->assertOk();
});

test('profile information can be updated', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('username', 'username')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Test User');
    expect($user->username)->toEqual('username');
    expect($user->email)->toEqual('test@example.com');
    expect($user->email_verified_at)->toBeNull();
});

test('a username is constrained to be unique', function (): void {
    $jane = User::factory()->create([
        'username' => 'jane',
    ]);
    $john = User::factory()->create([
        'username' => 'john',
    ]);

    $this->actingAs($john);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('username', 'jane')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation');

    $response->assertHasErrors();

    $john->refresh();

    expect($john->username)->toEqual('john');
});

test('a username is constrained to not be in the reserved list', function (): void {
    $john = User::factory()->create([
        'username' => 'john',
    ]);

    $this->actingAs($john);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('username', 'anonymous')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation');

    $john->refresh();

    expect($john->username)->toEqual('john');
});

test('email verification status is unchanged when email address is unchanged', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('username', 'JonSnow')
        ->set('email', $user->email)
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

test('user can delete their account', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test('settings.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser');

    $response
        ->assertHasNoErrors()
        ->assertRedirect('/');

    expect($user->fresh())->toBeNull();
    expect(auth()->check())->toBeFalse();
});

test('correct password must be provided to delete account', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test('settings.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser');

    $response->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
});
