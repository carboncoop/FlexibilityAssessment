<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\AssessmentsList;
use Tests\Browser\Pages\Assessment;

class FlexibilityAssessmentTest extends DuskTestCase {
    /**
     * Test creation and deletion of assessments
     *
     * @return void
     */
    /* public function testAssessmentManagement() {
      $this->browse(function (Browser $browser) {
      $name = 'test assessment name ' . rand();
      $browser->visit(new AssessmentsList)
      ->createAssessment($name, "A description")
      ->assertSee($name)
      ->deleteAssessment($name)
      ->assertDontSee($name);
      });
      } */

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
                    ->assertVue('assessment.description', $newDescription, '@assessment-form-component');

            $browser->visit(new AssessmentsList)
                    ->deleteAssessment($newName);
        });
    }

}
