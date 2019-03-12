<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();

        foreach($users as $user) {
            for($i=1; $i<=10; $i++) {
                $contact = factory(App\Contact::class)->make();
                $user->contacts()->save($contact);
            }
        }
    }
}
