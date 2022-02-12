<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Genre;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $data =  array(
            ['name' => 'BLUES'],
            ['name' => 'COUNTRY'],
            ['name' => 'ELETRONIC'],
            ['name' => 'HIP HOP'],
            ['name' => 'JAZZ'],
            ['name' => 'POP'],
            ['name' => 'ROCK']

        );
        foreach ($data as $datum){
            $genre = new Genre();
            $genre->name = $datum['name'];
            $genre->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
