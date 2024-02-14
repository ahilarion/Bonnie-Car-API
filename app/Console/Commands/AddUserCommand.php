<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user {email} {password} {first_name} {last_name} {--admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $first_name = $this->argument('first_name');
        $last_name = $this->argument('last_name');
        $admin = $this->option('admin');

        if (User::where('email', $email)->exists()) {
            $this->error('User already exists');
            return;
        }

        $user = User::create([
            'email' => $email,
            'password' => Hash::make($password),
            'first_name' => $first_name,
            'last_name' => $last_name,
        ]);

        $user->markEmailAsVerified();

        $this->checkIfRoleExists();

        if ($admin) {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');
        }

        $this->info('User created successfully');
    }

    private function checkIfRoleExists(): void
    {
        if (Role::where('name', 'admin')->doesntExist()) {
            Role::create(['name' => 'admin']);
        }

        if (Role::where('name', 'user')->doesntExist()) {
            Role::create(['name' => 'user']);
        }
    }
}
