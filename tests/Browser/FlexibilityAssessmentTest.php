<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\Browser\Pages\AssessmentsList;
use Tests\Browser\Pages\Assessment;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\Login;

class FlexibilityAssessmentTest extends DuskTestCase {
    
    
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

    
    
    /**
     * Test creation and deletion of assessments
     *
     * @return void
     */
    public function testAssessmentManagement() {
        $this->browse(function (Browser $browser) {
            $name = 'test assessment name ' . rand();
            $browser->visit(new AssessmentsList)
                    ->createAssessment($name, "A description")
                    ->assertSee($name)
                    ->deleteAssessment($name)
                    ->assertDontSee($name);
        });
    }

    /**
     * Test assessment data flows through the different Vue components
     *
     * @return void
     */
    public function testAssessmentDataFlow() {
        $this->browse(function (Browser $browser) {
            $name = 'test assessment name ' . rand();
            $browser->visit(new AssessmentsList)
                    ->createAssessment($name, "A description");
            $assessment = \App\assessment::where('name', $name)->firstOrFail();

            $newName = 'test assessment new name ' . rand();
            $newDescription = 'New description';
            $browser->visit(new Assessment($assessment))
                    ->changeNameAndDescription($newName, $newDescription)
                    ->assertVue('assessment.name', $newName, '@assessment-side-menu-component')
                    ->assertVue('assessment.description', $newDescription, '@assessment-side-menu-component')
                    ->assertVue('assessment.name', $newName, '@assessment-form-component')
                    ->assertVue('assessment.description', $newDescription, '@assessment-form-component')
                    ->changeAddress1('New address')
                    ->pause(1000)
                    ->assertVue('assessment.data.address1', 'New address', '@assessment-form-component')
                    ->assertVue('assessment.data.address1', 'New address', '@assessment-side-menu-component');

            $browser->visit(new AssessmentsList)
                    ->deleteAssessment($newName);
        });
    }

    /**
     * Test the user can browse all the pages and views
     *
     * @return void
     */
    public function testNavigation() {
        $this->browse(function (Browser $browser) {
            $name = 'test assessment name ' . rand();
            $browser->visit(new AssessmentsList)
                    ->createAssessment($name, "A description");
            $assessment = \App\assessment::where('name', $name)->firstOrFail();

            $browser->click('.open-assessment[assessment-id="' . $assessment->id . '"]')
                    ->waitUntilMissing('#assessment-table-component')
                    ->waitFor('#assessment')
                    ->assertPathIs('/assessment/' . $assessment->id . '/edit')
                    ->assertVisible('#assessment-form')
                    ->assertMissing('#assessment-report')
                    ->click('@show-report')
                    ->assertVisible('#assessment-report')
                    ->click('@show-form')
                    ->assertVisible('#assessment-form')
                    ->clickLink('Assessments')
                    ->assertPathIs('/assessment')
                    ->assertTitle('Flexibility assessment - List');

            $browser->visit(new AssessmentsList)
                    ->deleteAssessment($name);
        });
    }

}
