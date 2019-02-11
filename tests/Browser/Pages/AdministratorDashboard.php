<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class AdministratorDashboard extends Page {

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url() {
        return '/organisation-administrator-dashboard';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser) {
        $browser->assertTitle('Flexibility assessment - Organisation Administrator dashboard');
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
     * Create a new User.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $name
     * @param  string  $description
     * @return void
     */
    public function createUser(Browser $browser, $name, $email, $password) {
        $browser->clickLink('Users')
                ->press('New')
                ->waitFor('#new-user-modal___BV_modal_outer_')
                ->type('@input-name', $name)
                ->type('@input-email', $email)
                ->select('@select-role')
                ->type('password', $password)
                ->type('confirm-password', $password)
                ->press('OK')
                ->waitUntilMissing('#new-user-modal___BV_modal_outer_');
    }

    /**
     * Delete user.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $name
     * @return void
     */
    public function deleteUser(Browser $browser, $name) {
        $browser->clickLink('Users')
                ->click('@delete-user-' . $name)
                ->waitFor('#delete-user-modal___BV_modal_outer_')
                ->press('OK')
                ->waitUntilMissing('#delete-user-modal___BV_modal_outer_');
    }

        /**
     * Edit user.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $name
     * @param  string  $email
     * @param  string  $role Should be a valid role
     * @return void
     */
    public function editUser(Browser $browser, $name, $newName, $newEmail, $newRole) {
        $browser->clickLink('Users')
                ->click('@edit-user-' . $name)
                ->waitFor('#edit-user-modal___BV_modal_outer_')
                ->type('@edit-name', $newName)
                ->type('@edit-email', $newEmail)
                ->select('@edit-role', $newRole)
                ->press('Save')
                ->waitUntilMissing('#edit-user-modal___BV_modal_outer_');
    }
    
         /**
     * Edit organisation details.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $name
     * @param  string  $email
     * @param  string  $role Should be a valid role
     * @return void
     */
    public function editOrganisationDetails(Browser $browser, $name, $email, $telephone, $address1, $address2,$city_town, $postcode, $postcode_zones) {
        $browser->clickLink('Org. Details')
                ->press('Edit')
                ->waitFor('@organisation-name-input')
                ->type("@organisation-name-input",$name)
                ->type("@organisation-email-input",$email)
                ->type("@organisation-telephone-input",$telephone)
                ->type("@organisation-address1-input",$address1)
                ->type("@organisation-address2-input",$address2)
                ->type("@organisation-city_town-input",$city_town)
                ->type("@organisation-postcode-input",$postcode)
                ->type("@organisation-postcode_zones-input",$postcode_zones)
                ->press('Save')
                ->waitFor('@organisation-name-text');
    }
    
}
