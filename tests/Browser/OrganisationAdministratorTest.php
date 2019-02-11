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
use Tests\Browser\Pages\AdministratorDashboard;

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

    /**
     * Administrator can edit organisation details
     * 
     * @return void
     */
    public function testEditOrganisationDetails() {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn("administrator@org1.com", "password")
                    ->visit(new AdministratorDashboard)
                    ->clickLink('Org. Details');

            $name = $browser->text('@organisation-name-text');
            $email = $browser->text('@organisation-email-text');
            $telephone = rand();
            $address1 = rand();
            $address2 = rand();
            $postcode = rand();
            $city_town = rand();
            $postcode_zones = rand();

            $browser->visit(new AdministratorDashboard)
                    ->editOrganisationDetails($name, $email, $telephone, $address1, $address2, $city_town, $postcode, $postcode_zones)
                    ->assertMissing('@organisation-edit-error')
                    ->assertSeeIn('@organisation-telephone-text', $telephone);
        });
    }

}
