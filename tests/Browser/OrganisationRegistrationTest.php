<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\Browser\Pages\AssessmentsList;
use Tests\Browser\Pages\Assessment;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\Login;

class OrganisationRegistrationTest extends DuskTestCase {
    
    use RefreshDatabase;
    
    /**
     * Register an organisation and user
     *
     * @return void
     */
    public function testOrganisationRegistration() {
        $this->browse(function (Browser $browser) {
            $name = 'test organization name ' . rand();
            $email = 'test_org_email' . rand() . '@flexibility.org';
            $contactPerson = 'test contact person ' . rand();
            $contactPersonEmail = 'contact_person_email' . rand() . '@flexibility.org';
            $password = rand();

            $browser->visit(new Register)
                    ->registerOrganisation($name, $email, "07777777777", "postcode zones", "address 1", "address 2", "postcode", "town_city", $contactPerson, $contactPersonEmail, $password)
                    ->assertPathIs('/assessment')
                    ->click('#logout-link');

            $browser->click('#login-link')
                    ->on(new Login)
                    ->logUserIn($contactPersonEmail, $password)
                    ->assertPathIs('/assessment')
                    ->click('#logout-link');
        });
    }      

}
