# Flexibility Assessment Tool test
We do browser tests with dusk

# Before running the tests
Some of the tests use specific users so you need to seed the database `php artisan db:seed --class=TestsSeeder`
We do it this way because seeding the database during the tests  makes them very slow.

# To run the tests
To run all the tests, in the command line `php artisan dusk`
To run a specific test file: `php artisan dusk tests/Browser/TheTestFile.php`
To run a specific test in a test file: `php artisan dusk --filter theTest`