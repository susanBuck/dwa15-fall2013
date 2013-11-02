<?php
class practice_controller extends base_controller{
	public function test_db(){
	# Our SQL command
		$q = "INSERT INTO users SET
         	first_name = 'Bob', 
    		last_name = 'Seaborn',
    		email = 'seaborn@whitehouse.gov'";
                        
            echo $q;
            DB::instance(DB_NAME)->query($q);

	}
} # eoc