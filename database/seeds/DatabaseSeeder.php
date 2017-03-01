<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $users = ['ashish', 'anita', 'kedar'];
    foreach ($users as $key => $user) {
      DB::table('users')->insert([
          'name' => $user,
          'email' => $user . '@gmail.com',
          'password' => bcrypt($user),
          'role_id' => $key + 1,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
      ]);
    }

    DB::table('roles')->insert([
        ['name' => 'core'],
        ['name' => 'main'],
        ['name' => 'editor'],
        ['name' => 'admin'],
        ['name' => 'normal'],
    ]);

    DB::table('companies')->insert([
      // 'name' => str_random(10),
      'name' => 'Asdh Corporate',
      'email' => 'ashish@gmail.com',
      'established_date' => date('Y-m-d h:i:s'),
      'address' => 'Anamnagar, Kathmandu',
      'phone' => '9843632084',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ]);

    $navigations = ['categories' => 'category', 'posts' => 'post', 'tags' => 'tag', 'users' => 'user', 'company' => 'company', 'navigations' => 'navigation'];
    foreach ($navigations as $key => $value) {
      DB::table('navigations')->insert([
          'name' => $key,
          'link' => 'http://asdh.web/ashish/admin/' . $value,
          'admin' => '1',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }

    DB::table('categories')->insert([
        'name' => 'default',
        'slug' => 'default',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
  }
}
