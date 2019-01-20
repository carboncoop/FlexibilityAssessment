<?php

/* * ******************************
 * 
 * The aim of this test file is to develop new tests. Once the test is working 
 * it can be moved to the main tests file FlexibilityAssessmentTest.php and commit the changes
 * 
 * For running the test in this file (from the root of the laravel installation): 
 *  `php artisan dusk tests/Browser/DevelopmentTestsTest.php`
 * 
 * ******************************* */

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
// Pages that can be used by a test
use Tests\Browser\Pages\AssessmentsList;
use Tests\Browser\Pages\Assessment;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\Login;

class DevelopmentTestsTest extends DuskTestCase {


}
