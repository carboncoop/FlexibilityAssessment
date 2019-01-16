# Flexibility Assessment tool
Developed by Carbon Co-op with Community Energy Scotland and South Seeds


## License
This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.


##Installation - Production

Clone this repository `git clone https://github.com/carboncoop/FlexibilityAssessment.git installation_directory`

Install laravel dependencies: `composer install --no-dev`

Install javascript dependencies `npm install --production`

Configure your environment variables by copying .env.example into .env (follow the content)

Generate the application key `php artisan key:generate`


##Installation - Development

Comes with Telescope for debugging and Dusk for tests.

Clone this repository `git clone https://github.com/carboncoop/FlexibilityAssessment.git installation_directory`

Install laravel dependencies: `composer install`

Install javascript dependencies `npm install`

Configure your environment variables by copying .env.example into .env (follow the content)

Generate the application key `php artisan key:generate`