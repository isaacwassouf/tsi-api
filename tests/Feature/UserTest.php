<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to check if the user can register successfully.
     */
    public function testRegisterUserSuccessfully(): void
    {
        $response = $this->post('/auth/register', [
            'first_name' => 'Isaac',
            'last_name' => 'Wassouf',
            'email' => 'isaacwassouf@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSuccessful();
    }

    /**
     * A test to check if the user can register successfully.
     */
    public function testRegisterPasswordsDontMatch(): void
    {
        $response = $this->post('/auth/register', [
            'first_name' => 'Isaac',
            'last_name' => 'Wassouf',
            'email' => 'isaacwassouf@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'wrongpassword',
        ]);

        $response->assertUnprocessable();
    }

    /**
     * A test to check if the user can log in successfully.
     */
    public function testLoginUserSuccessfully(): void
    {
        $this->post('/auth/register', [
            'first_name' => 'Isaac',
            'last_name' => 'Wassouf',
            'email' => 'isaacwassouf@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->post('/auth/login', [
            'email' => 'isaacwassouf@gmail.com',
            'password' => 'password',
        ]);

        $response->assertSuccessful();
    }

    /**
     * A test to check if the user can log in successfully.
     */
    public function testLoginUserWrongPassword(): void
    {
        $this->post('/auth/register', [
            'first_name' => 'Isaac',
            'last_name' => 'Wassouf',
            'email' => 'isaacwassouf@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->post('/auth/login', [
            'email' => 'isaacwassouf@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertBadRequest();
    }

    /**
     * A test to check if the user can log in successfully.
     */
    public function testLoginUserDoesntExist(): void
    {
        $response = $this->post('/auth/login', [
            'email' => 'isaacwassouf@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertUnprocessable();
    }
}
