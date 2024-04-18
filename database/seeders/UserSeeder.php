<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Prompt the user for how many users they want to create
        $userCount = $this->command->ask('How many users would you like to create?', 0);
        //If the user count is not a number, set it to 0
        if (!is_numeric($userCount)) {
            $userCount = 0;
        }
        //If the user count is less than 0, set it to 0
        if ($userCount < 0) {
            $userCount = 0;
        }
        //if not 0, loop through and create the users by prompting the user for the user details
        if ($userCount > 0) {
            $this->command->withProgressBar(range(0, $userCount), function ($userCount) {
                //start the progress bar
                $this->command->getOutput()->progressStart($userCount);
                for ($i = 0; $i < $userCount; $i++) {
                    $this->command->info('Creating user ' . ($i + 1) . ' of ' . $userCount);

                    //prompt the user for the user details
                    $userName = $this->command->ask('What is the name of the user?', 'User ' . ($i + 1));
                    //make sure the username is not empty
                    if (empty($userName)) {
                        $userName = 'User ' . ($i + 1);
                    }
                    $userEmail = $this->command->ask('What is the email of user?', 'user' . ($i + 1) . '@example.com');
                    //make sure the email is not empty
                    if (empty($userEmail)) {
                        $userEmail = 'user' . ($i + 1) . '@example.com';
                    }
                    $userPassword = $this->command->secret('What is the password of the user?');
                    //if the password is empty, set it to password and let the user know
                    if (empty($userPassword)) {
                        $userPassword = 'password';
                        $this->command->info('Password cannot be empty, setting it to "password"');
                    }
                    //prompt the user if the user should be an admin
                    $userIsAdmin = $this->command->confirm('Should this user be an admin?', false);

                    //try to create the user
                    try {
                        $this->createUser($userName, $userEmail, $userPassword, $userIsAdmin);
                    } catch (\Exception $e) {
                        $this->command->error('Failed to create user ' . ($i + 1) . ' of ' . $userCount . ': ' . $e->getMessage());
                    }

                    //show progress
                    $this->command->getOutput()->progressAdvance();

                    //sleep for a second to avoid rate limiting
                    sleep(1);
                }
                //finish the progress bar
                $this->command->getOutput()->progressFinish();
            });
        }
    }

    /**
     * User creation seeder
     *
     * @var string $userName
     * @var string $userEmail
     * @var string $userPassword
     * @var bool $userIsAdmin
     *
     * @return bool
     * @throws \Exception
     */
    public function createUser(string $userName, string $userEmail, string $userPassword, bool $userIsAdmin = false): bool
    {
        //set the userIsAdmin to an integer
        $isAdmin = $userIsAdmin ? 1 : 0;

        //check if the user already exists
        if (User::where('email', $userEmail)->exists()) {
            return false;
        }

        //check if this is the first user, if it is, make them an admin even if the bool is false
        if (User::count() === 0) {
            $isAdmin = 1;
        }

        //try to create a new user, if it fails return false
        try {
            User::create([
                'name' => $userName,
                'email' => $userEmail,
                'password' => bcrypt($userPassword),
                'is_admin' => $isAdmin,
            ]);
        } catch (\Exception $e) {
            return false;
        }

        //return true if the user was created
        return true;
    }
}
