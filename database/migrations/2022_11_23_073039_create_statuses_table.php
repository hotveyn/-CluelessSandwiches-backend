<?php

use App\Models\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->enum("name", [
                Status::PROCESSING,
                Status::ACCEPTED,
                Status::PREPARING,
                Status::READY,
                Status::DONE
            ]);
            $table->timestamps();
        });

        DB::table("statuses")->insert([
            ["name" => Status::PROCESSING],
            ["name" => Status::ACCEPTED],
            ["name" => Status::PREPARING],
            ["name" => Status::READY],
            ["name" => Status::DONE],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
};
