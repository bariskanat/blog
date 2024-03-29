<?php

class Create_Comments_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("comments",function($table){
                    $table->increments("id");
                    $table->integer("user_id");
                    $table->integer("post_id");
                    $table->text("comment");
                    $table->timestamps();
                    
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("commets");
	}

}