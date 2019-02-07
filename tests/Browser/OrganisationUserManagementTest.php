<?php

/* * ***********************************
 * These test expects specific users and assessments in the database
 * 
 * Ensure that the database has been seeded
 * *************************** */

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\AdministratorDashboard;
use Tests\Browser\Pages\Login;

class OrganisationUserManagementTest extends DuskTestCase {

    /**
     * Test creation and deletion user
     *
     * @return void
     */
    public function testCreationAndDeletionOfUser() {
        $this->browse(function (Browser $browser) {

            $name = 'User_name_' . rand();
            $email = $name . "@email.com";

            // Create user
            $browser->visit(new Login)
                    ->logUserIn("administrator@org1.com", "password")
                    ->visit(new AdministratorDashboard)
                    ->createUser($name, $email, 'password')
                    ->assertSee($name)
                    ->assertSee($email)
                    ->click('#user-name')
                    ->click('#logout-link');

            // Login as new user
            $browser->visit(new Login)
                    ->logUserIn($email, "password")
                    ->waitFor('#user-name')
                    ->assertSee($name)
                    ->click('#user-name')
                    ->click('#logout-link');

            // Delete user
            $browser->visit(new Login)
                    ->logUserIn("administrator@org1.com", "password")
                    ->visit(new AdministratorDashboard)
                    ->deleteUser($name)
                    ->assertDontSee($name)
                    ->click('#user-name')
                    ->click('#logout-link');

            // Try to login again
            $browser->visit(new Login)
                    ->logUserIn($email, "password", false)
                    ->waitForText('These credentials do not match our records.');
        });
    }

    /**
     * Test edit user
     *
     * @return void
     */
    public function testEditUser() {
        $this->browse(function (Browser $browser) {

            $name = 'User_name_' . rand();
            $email = $name . "@email.com";

            // Create user
            $browser->visit(new Login)
                    ->logUserIn("administrator@org1.com", "password")
                    ->visit(new AdministratorDashboard)
                    ->createUser($name, $email, 'password')
                    ->assertSee($name)
                    ->assertSee($email);

            // Edit user
            $newName = 'User_name_' . rand();
            $newEmail = $newName . "@email.com";
            $browser->editUser($name, $newName, $newEmail, 'invited')
                    ->assertSee($newName)
                    ->assertSee($newEmail)
                    ->assertDontSee($name)
                    ->assertDontSee($email)
                    ->click('#user-name')
                    ->click('#logout-link');

            // Login with new credentials
            $browser->visit(new Login)
                    ->logUserIn($newEmail, "password")
                    ->waitFor('#user-name')
                    ->assertSee($newName)
                    ->click('#user-name')
                    ->click('#logout-link');

            // Delete user
            $browser->visit(new Login)
                    ->logUserIn("administrator@org1.com", "password")
                    ->visit(new AdministratorDashboard)
                    ->deleteUser($newName)
                    ->assertDontSee($newName)
                    ->click('#user-name')
                    ->click('#logout-link');
        });
    }

}
