<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Register extends Page {

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url() {
        return '/register';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser) {
        $browser->assertTitle('Flexibility assessment - Register');
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
     * Register organisation
     *
     * @param  Browser $browser
     * @param string $name
     * @param string $email
     * @param string $telephone
     * @param string $postcode_zones
     * @param string $address1
     * @param string $address2
     * @param string $postcode
     * @param string $city_town
     * @param string $contact_person
     * @param string $contact_person_email
     * @param string $password
     */
    public function registerOrganisation(Browser $browser, $name, $email, $telephone, $postcode_zones, $address1, $address2, $postcode, $city_town, $contact_person, $contact_person_email, $password) {
        $browser->type('organisation_name', $name)
                ->type('organisation_email', $email)
                ->type('telephone', $telephone)
                ->type('postcode_zones', $postcode_zones)
                ->type('address1', $address1)
                ->type('address2', $address2)
                ->type('postcode', $postcode)
                ->type('city_town', $city_town)
                ->type('contact_person_name', $contact_person)
                ->type('contact_person_email', $contact_person_email)
                ->type('password', $password)
                ->type('password_confirmation', $password)
                ->press('Register')
                ->waitUntilMissing('#registration-form');
    }

}
