<?php

use Illuminate\Database\Seeder;
use App\Models\Source;

class DatabaseSeeder extends Seeder
{
    private $sources = [
        'Www.ad.nl' => 'AD',
        'Telegraaf.nl' => 'Telegraaf',
        'Www.nrc.nl' => 'NRC',
        'Volkskrant.nl' => 'Volkskrant',
        'Nos.nl' => 'NOS',
        'Www.nu.nl' => 'Nu.nl',
        'Trouw.nl' => 'Trouw',
        'Parool.nl' => 'Parool',
        'www.metro.nl' => 'Metro',
        'Standaard.be' => 'Standaard.be',
        'Www.hln.be' => 'HLM.be',
        'RTL Nieuws' => 'RTL Nieuws',
        'Fd.nl' => 'FD',
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sources as $key => $value) {
            Source::create([
                'name' => $value,
                'external_id' => $key
            ]);
        }
    }
}
