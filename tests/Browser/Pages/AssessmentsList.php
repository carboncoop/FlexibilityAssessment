<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class AssessmentsList extends Page {

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url() {
        return '/assessment';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser) {
        $browser->assertTitle('Flexibility assessment - List');
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements() {
        return [
                //'@element' => '#selector',
        ];
    }

    /**
     * Create a new assessment.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $name
     * @param  string  $description
     * @return void
     */
    public function createAssessment(Browser $browser, $name, $description) {
        $browser->click('@new-button')
                ->waitFor('#new-assessment-modal___BV_modal_outer_')
                ->type('name', $name)
                ->type('description', $description)
                //->click('#new-assessment-modal___BV_modal_outer_ .btn-primary')
                ->press('OK')
                ->waitUntilMissing('#new-assessment-modal___BV_modal_outer_');
    }

    /**
     * Delete assessment.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $name
     * @return void
     */
    public function deleteAssessment(Browser $browser, $name) {
        $browser->click('.delete-button[assessment-name="' . $name . '"]')
                ->waitFor('#delete-assessment-modal___BV_modal_outer_')
                //->click('#delete-assessment-modal___BV_modal_outer_ .btn-primary')
                ->press('OK')
                ->waitUntilMissing('#delete-assessment-modal___BV_modal_outer_');
    }

}
