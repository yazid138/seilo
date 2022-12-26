<?php

use App\Models\Address;
use App\Models\Education;
use App\Models\Media;
use App\Models\SocialMedia;
use App\Models\User;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Address::class)->constrained();
            $table->foreignIdFor(Media::class, 'foto_id')->constrained('media', 'id');
            $table->foreignIdFor(Education::class)->constrained();
            $table->foreignIdFor(SocialMedia::class)->nullable()->constrained();
            $table->string('phone', 15);
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->string('about_me');
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
        Schema::dropIfExists('profiles');
    }
};
