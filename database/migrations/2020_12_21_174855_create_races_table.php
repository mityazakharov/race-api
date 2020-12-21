<?php

use App\Models\Discipline;
use App\Models\Season;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->date('date_at');
            $table->foreignIdFor(Season::class, 'season_id');
            $table->smallInteger('stage');
            $table->foreignIdFor(Discipline::class, 'discipline_id');
            $table->boolean('is_final')->default(false);

            $table->unique(['season_id', 'stage']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races');
    }
}
