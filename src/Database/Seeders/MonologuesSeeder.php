<?php

namespace Astrogoat\Monologues\Database\Seeders;

use Astrogoat\Monologues\Enums\CharacterSex;
use Astrogoat\Monologues\Enums\TheatricalType;
use Astrogoat\Monologues\Models\Monologue;
use Astrogoat\Monologues\Models\Play;
use Illuminate\Database\Seeder;

class MonologuesSeeder extends Seeder
{
    public function run()
    {
        if (app()->environment('production')) {
            return;
        }

        $redLightWinter = Play::query()->firstOrCreate(
            ['title' => 'Red Light Winter'],
            [
                'playwright' => 'Adam Rapp',
                'published_year' => '2006',
                'type' => TheatricalType::DRAMA,
            ]
        );

        $theDevilsBetweenUs = Play::query()->firstOrCreate(
            ['title' => 'The Devils Between Us'],
            [
                'playwright' => 'Sharifa Yasmin',
                'published_year' => '2021',
                'type' => TheatricalType::DRAMA,
                'where_to_find' => 'PK; The Methuen Drama Book of Trans Plays',
            ]
        );

        $monologue = <<<TEXT
Occaecat minim exercitation consectetur velit ipsum veniam non fugiat laborum nisi ut ut veniam. Nostrud enim reprehenderit voluptate voluptate fugiat aliqua ut do dolore. Proident excepteur excepteur id sunt fugiat nulla. Adipisicing dolor deserunt eu nostrud est incididunt reprehenderit. Veniam aute aute elit aliqua. Elit elit cupidatat est.

Sit sunt magna nisi laborum. Aute ullamco Lorem commodo sint labore eu veniam duis non reprehenderit. Officia enim in aliqua esse labore incididunt. Exercitation irure culpa Lorem enim nulla et aliquip ipsum veniam ex laborum Lorem fugiat enim Lorem. Elit adipisicing ullamco magna do eiusmod mollit. Do in cupidatat consectetur velit ad nisi amet duis ipsum aliqua fugiat ipsum est. Est sunt nostrud irure amet consectetur. Adipisicing quis ex magna occaecat ipsum incididunt ex nisi esse anim nostrud quis culpa tempor cupidatat.

Anim officia nostrud cillum Lorem cillum duis ad. Ipsum amet irure esse ipsum adipisicing minim reprehenderit elit amet consequat duis anim. Commodo exercitation qui nostrud dolore ut velit. Est sint amet commodo quis reprehenderit ea commodo consectetur.
TEXT;

        Monologue::query()->firstOrCreate(
            ['play_id' => $redLightWinter->id],
            [
                'character' => 'Matt',
                'sex' => CharacterSex::M,
                'type' => TheatricalType::DRAMA,
                'description' => "Matt reveals what it's been like since they slept together in Amsterdam a year ago.",
                'excerpt' => "I sleep with your dress. The red one that you changed into that night in Amsterdam.",
                'text' => $monologue,
            ]
        );

        Monologue::query()->firstOrCreate(
            ['play_id' => $theDevilsBetweenUs->id],
            [
                'character' => 'Latifa',
                'sex' => CharacterSex::F,
                'type' => TheatricalType::DRAMA,
                'age' => 'Late 20\'s',
                'identity' => 'Trans Arab woman',
                'description' => "Latifa returns to her hometown and confronts George about hating himself because he's gay and in the closet and has been since they were kids.",
                'excerpt' => "He’s dead. You don’t need to defend that asshole anymore.",
                'text' => $monologue,
            ]
        );
    }
}
