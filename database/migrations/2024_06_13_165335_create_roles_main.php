<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */

  public function up()
  {

    //$user = User::find(1);

    $role1 = Role::create(['name' => 'admin']);
    $role2 = Role::create(['name' => 'user']);
    //  $user->assignRole($role1);
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('roles_main');
  }
};
