<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Assessment extends Page {

    public $assessment;

    /**
     * Constructor
     *
     * @param Assessment $a
     */
    public function __construct($a) {
        $this->assessment = $a;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url() {
        return '/assessment/' . $this->assessment->id . '/edit';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser) {
        $browser->assertTitle('Flexibility assessment - ' . $this->assessment->name);
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
     * Change name and description 
     *
     * @param  Browser $browser
     * @param string $name
     * @param string $description
     */
    public function changeNameAndDescription(Browser $browser, $name, $description) {
        $browser->click('@edit-name-description')
                ->waitFor('#edit-metadata-modal___BV_modal_outer_')
                ->type('name', $name)
                ->type('description', $description)
                ->press('OK')
                ->waitUntilMissing('#edit-metadata-modal___BV_modal_outer_');
    }

}
