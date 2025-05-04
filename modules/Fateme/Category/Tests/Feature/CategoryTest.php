<?php

namespace Fateme\Category\Tests\Feature;

use Fateme\Category\Models\Category;
use Fateme\Course\Database\Seeds\RolePermissionTableSeeder;
use Fateme\RolePermissions\Models\Permission;
use Fateme\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Contracts\Role;
use Tests\TestCase;
class CategoryTest  extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function  test_permitted_user_can_see_categories_panel()
    {
        $this->actionAsAdmin();
        $this->get(route('categories.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_categories_panel()
    {
        $this->actionAsUser();
        $this->get(route('categories.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_create_category()
    {
        $this->withoutExceptionHandling();
        $this->actionAsAdmin();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
    }

    public function test_permitted_user_can_update_category()
    {
        $newTitle = 'aasdf123';
        $this->actionAsAdmin();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->patch(route('categories.update', 1), ['title' => $newTitle, 'slug' => $this->faker->word]);
        $this->assertEquals(1, Category::whereTitle($newTitle)->count());
    }


    public function test_user_can_delete_category()
    {
        $this->actionAsAdmin();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
       $this->delete(route('categories.destroy',1))->assertOK();
    }

    private function actionAsAdmin()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(RolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }
    private function actionAsUser()
    {
        $this->seed(RolePermissionTableSeeder::class);
        $this->actingAs(User::factory()->create());
    }

    private function createCategory()
    {
        $this->post(route('categories.store'),["title"=>$this->faker->word, "slug"=>$this->faker->word]);
    }


}
