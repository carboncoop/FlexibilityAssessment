<?php

/* * ***********************************
 * These test expects specific users and assessments in the database
 * 
 * Ensure that the database has been seeded
 * *************************** */

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\AssessmentsList;
use Tests\Browser\Pages\Assessment;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\Login;

class OrganisationAdministratorTest extends DuskTestCase {

    

    /**
     * Guest cannot see the administrator dashboard
     *
     * @return void
     */
    public function testGuestCannotSeeDashboard() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn('invited@org1.com', 'password')
                    ->visit('/organisation-administrator-dashboard')
                    ->assertTitle("Forbidden")
                    ->visit('/')
                    ->click('#user-name')
                    ->click('#logout-link');
            

            
        });
    }
    
    /**
     * Assessor cannot see the administrator dashboard
     *
     * @return void
     */
    public function testAssessorCannotSeeDashboard() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn("assessor@org1.com", "password")
                    ->visit('/organisation-administrator-dashboard')
                    ->assertTitle("Forbidden")
                    ->visit('/')
                    ->click('#user-name')
                    ->click('#logout-link');
        });
    }

}

