<?php

use App\Models\Address;
use App\Models\Media;
use App\Models\SocialMedia;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Address::class)->constrained();
            $table->foreignIdFor(SocialMedia::class)->nullable()->constrained();
            $table->foreignIdFor(Media::class, 'foto_id')->constrained('media', 'id');
            $table->string('name');
            $table->string('phone', 15);
            $table->string('url');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
