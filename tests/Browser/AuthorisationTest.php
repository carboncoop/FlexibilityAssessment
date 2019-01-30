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
use App\Assessment as AssessmentModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;

class AuthorisationTest extends DuskTestCase {

    /**
     * Test that an administrator can see all the assessment of it's organisation but not of others
     *
     * @return void
     */
    public function testAdministatorSeesAllAssessments() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn("administrator@org1.com", "password")
                    ->assertPathIs('/assessment')
                    ->assertSee('Belongs to administrator')
                    ->assertSee('Belongs to assessor')
                    ->assertSee('Belongs to guest')
                    ->click('#logout-link');
        });
    }

    /**
     * Test that an assessor and guest users can only see their own assessments
     *
     * @return void
     */
    public function testAssessorAndGuestSeeOnlyTheirAssessments() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn("assessor@org1.com", "password")
                    ->assertPathIs('/assessment')
                    ->assertDontSee('Belongs to administrator')
                    ->assertSee('Belongs to assessor')
                    ->assertDontSee('Belongs to guest')
                    ->click('#logout-link');

            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn("guest@org1.com", "password")
                    ->assertPathIs('/assessment')
                    ->assertDontSee('Belongs to administrator')
                    ->assertDontSee('Belongs to assessor')
                    ->assertSee('Belongs to guest')
                    ->click('#logout-link');
        });
    }

    /**
     * Test that  administrators can edit all the assessment in the organisation
     *
     * @return void
     */
    public function testAdministratorEditsAllAssessments() {

        $this->browse(function (Browser $browser) {
            $admin_user = User::where('email', '=', "administrator@org1.com")->first();
            $assessor_user = User::where('email', '=', "assessor@org1.com")->first();
            $guest_user = User::where('email', '=', "guest@org1.com")->first();

            $admin_assessment = AssessmentModel::where('owner_id', '=', $admin_user->id)->first();
            $assessor_assessment = AssessmentModel::where('owner_id', '=', $assessor_user->id)->first();
            $guest_assessment = AssessmentModel::where('owner_id', '=', $guest_user->id)->first();

            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn("administrator@org1.com", "password")
                    ->visit(new Assessment($admin_assessment))
                    ->assertTitle("Flexibility assessment - " . $admin_assessment->name)
                    ->visit(new Assessment($assessor_assessment))
                    ->assertTitle("Flexibility assessment - " . $assessor_assessment->name)
                    ->visit(new Assessment($guest_assessment))
                    ->assertTitle("Flexibility assessment - " . $guest_assessment->name)
                    ->click('#logout-link');
        });
    }

    /**
     * Test that assessors can only edit their own assessments
     *
     * @return void
     */
    public function testAssessorOnlyEditsOwnAssessments() {

        $this->browse(function (Browser $browser) {
            $admin_user = User::where('email', '=', "administrator@org1.com")->first();
            $assessor_user = User::where('email', '=', "assessor@org1.com")->first();
            $guest_user = User::where('email', '=', "guest@org1.com")->first();

            $admin_assessment = AssessmentModel::where('owner_id', '=', $admin_user->id)->first();
            $assessor_assessment = AssessmentModel::where('owner_id', '=', $assessor_user->id)->first();
            $guest_assessment = AssessmentModel::where('owner_id', '=', $guest_user->id)->first();

            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn("assessor@org1.com", "password")
                    ->visit("assessment/" . $admin_assessment->id . "/edit")
                    ->assertTitle("Forbidden")
                    ->visit("assessment/" . $assessor_assessment->id . "/edit")
                    ->assertTitle("Flexibility assessment - " . $assessor_assessment->name)
                    ->visit("assessment/" . $guest_assessment->id . "/edit")
                    ->assertTitle("Forbidden")
                    ->visit('/')
                    ->click('#logout-link');
        });
    }

    /**
     * Test that guests can only edit their own assessments
     *
     * @return void
     */
    public function testGuestOnlyEditsOwnAssessments() {

        $this->browse(function (Browser $browser) {
            $admin_user = User::where('email', '=', "administrator@org1.com")->first();
            $assessor_user = User::where('email', '=', "assessor@org1.com")->first();
            $guest_user = User::where('email', '=', "guest@org1.com")->first();

            $admin_assessment = AssessmentModel::where('owner_id', '=', $admin_user->id)->first();
            $assessor_assessment = AssessmentModel::where('owner_id', '=', $assessor_user->id)->first();
            $guest_assessment = AssessmentModel::where('owner_id', '=', $guest_user->id)->first();

            $browser->visit('/')
                    ->click('#login-link')
                    ->on(new Login)
                    ->logUserIn("guest@org1.com", "password")
                    ->visit("assessment/" . $admin_assessment->id . "/edit")
                    ->assertTitle("Forbidden")
                    ->visit("assessment/" . $assessor_assessment->id . "/edit")
                    ->assertTitle("Forbidden")
                    ->visit("assessment/" . $guest_assessment->id . "/edit")
                    ->assertTitle("Flexibility assessment - " . $assessor_assessment->name)
                    ->visit('/')
                    ->click('#logout-link');
        });
    }

}

