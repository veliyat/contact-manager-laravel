<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $contacts = App\Contact::all();

        foreach($contacts as $contact) {
            $address = factory(App\Address::class)->make();
            $contact->addresses()->save($address);
        }
    }
}
