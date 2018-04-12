<?php

use Illuminate\Database\Seeder;
use App\Models\Source;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::raw(
            'LOCK TABLES `sources` WRITE;
/*!40000 ALTER TABLE `sources` DISABLE KEYS */;

INSERT INTO `sources` (`id`, `external_id`, `name`, `created_at`, `updated_at`, `image`, `w_political`, `w_progressive`, `w_age`, `ws_entertainment`, `ws_foreign`, `ws_political`, `ws_sports`, `ws_generic`, `ws_culture`, `ws_economics`)
VALUES
	(1,\'Www.ad.nl\',\'AD\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,70,60,50,80,40,40,70,60,30,40),
	(2,\'Telegraaf.nl\',\'Telegraaf\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,80,70,51,80,40,50,70,70,30,60),
	(3,\'Www.nrc.nl\',\'NRC\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,50,50,52,10,80,70,20,60,70,70),
	(4,\'Volkskrant.nl\',\'Volkskrant\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,40,30,50,10,70,60,20,60,80,50),
	(5,\'Nos.nl\',\'NOS\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,40,40,50,10,80,70,70,70,40,50),
	(6,\'Www.nu.nl\',\'Nu.nl\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,50,50,40,70,40,40,50,70,30,50),
	(7,\'Trouw.nl\',\'Trouw\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,50,70,55,10,50,60,20,50,50,40),
	(8,\'Parool.nl\',\'Parool\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,40,30,50,10,20,40,30,30,60,30),
	(9,\'www.metro.nl\',\'Metro\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,70,40,43,70,30,30,50,50,20,30),
	(10,\'Standaard.be\',\'Standaard.be\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,50,50,52,10,80,70,20,60,60,60),
	(11,\'Www.hln.be\',\'HLM.be\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,80,70,45,80,20,30,60,70,30,30),
	(12,\'RTL Nieuws\',\'RTL Nieuws\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,60,60,45,30,50,50,30,70,30,60),
	(13,\'Fd.nl\',\'FD\',\'2018-04-12 14:39:29\',\'2018-04-12 14:39:29\',NULL,60,60,46,10,30,30,10,20,10,80);

/*!40000 ALTER TABLE `sources` ENABLE KEYS */;
UNLOCK TABLES;'
        );
    }
}
