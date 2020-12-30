<?php

use App\Models\Athlete;
use App\Models\Group;
use App\Models\Race;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Race::class, 'race_id');
            $table->foreignIdFor(Athlete::class, 'athlete_id');
            $table->foreignIdFor(Team::class, 'team_id');
            $table->string('rate', 5)->nullable();
            $table->foreignIdFor(Group::class, 'group_id');
            $table->smallInteger('bib')->nullable();
            $table->integer('run_1')->nullable();
            $table->string('status_1', 3)->nullable();
            $table->integer('run_2')->nullable();
            $table->string('status_2', 3)->nullable();
            $table->integer('total')->nullable();
            $table->integer('diff')->nullable();
            $table->smallInteger('place')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
