<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testAlpha()
    {
       

        $this->browse(function ($browser){
            $browser->visit('/login')
                    ->type('email', 'simon@simon.com')
                    ->type('password', '123456')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }

    public function testNumericos()
    {
        

        $this->browse(function ($browser){
            $browser->visit('/login')
                    ->type('email', '7777777777777')
                    ->type('password', '99999999999')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }

    public function testSimbolos()
    {
        

        $this->browse(function ($browser){
            $browser->visit('/login')
                    ->type('email', '!@#$%^&*')
                    ->type('password', '!@#$%^&*')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }
}
