<?php

use App\Models\Query;  
use Illuminate\Database\Seeder;

class QueryTableSeeder extends Seeder  
{
	public function run()
	{
		Query::truncate();

		Query::create([
			'title'   => 'Employee Count',
			'query'   => 'SELECT COUNT(*) FROM employees',
			'user_id' => 3,
		]);

		Query::create([
			'title'   => 'Department Employee Count',
			'query'   => 'SELECT d.dept_name, COUNT(DISTINCT emp_no) AS `count` FROM dept_emp de LEFT JOIN departments d ON de.dept_no = d.dept_no GROUP BY d.dept_no ORDER BY `count` DESC',
			'user_id' => 2,
		]);

		Query::create([
			'title'   => 'Employee Titles',
			'query'   => 'SELECT CONCAT_WS(" ", e.first_name, e.last_name) AS `Name`, t.title FROM titles t LEFT JOIN employees e ON t.emp_no = e.emp_no GROUP BY e.emp_no',
			'user_id' => 1,
		]);
	}
}