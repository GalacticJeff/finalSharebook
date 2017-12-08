<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class registerTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    
    public function testAlpha()
    {
      

        $this->browse(function ($browser){
            $browser->visit('/register')
                    ->type('name', 'simon')
                    ->type('email', 'simon@simon.com')
                    ->type('password', '123456')
                    ->press('Register')
                    ->assertPathIs('/home');
        });
    }

    public function testNumericos()
    {
        
        $this->browse(function ($browser){
            $browser->visit('/register')
                    ->type('name', '99999999999999999')
                    ->type('email', '9999999999999999')
                    ->type('password', '999999999999999')
                    ->press('Register')
                    ->assertPathIs('/home');
        });
    }

    public function testSimbolos()
    {
        

        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', '!@#$%&$%^@#%@#$%')
                    ->type('email', '!@#$%^&*@#$@#$')
                    ->type('password', '!@#!#$%@#$%@#$^@#$')
                    ->press('Register')
                    ->assertPathIs('/home');
        });
    }
}
