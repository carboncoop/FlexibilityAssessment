<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\AssessmentsList;

class FlexibilityAssessmentTest extends DuskTestCase {

    /**
     * Test creationn and deletion of assessments
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

}
