<?php

use Illuminate\Database\Seeder;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = App\Contact::all();

        foreach($contacts as $contact) {
            $phone = factory(App\Phone::class)->make();
            $contact->phone()->save($phone);
        }
    }
}
