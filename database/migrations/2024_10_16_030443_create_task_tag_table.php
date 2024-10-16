<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('task_tag', function (Blueprint $table) {
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');

            // Set the primary key to be a composite of task_id and tag_id
            $table->primary(['task_id', 'tag_id']);

            // Add a composite index to speed up queries involving both task_id and tag_id
            $table->index(['task_id', 'tag_id'], 'task_tag_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_tag');
    }
};
