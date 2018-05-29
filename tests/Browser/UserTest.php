<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->make();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $user, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->clickLink('Add new')
                ->type("name", $user->name)
                ->type("lname", $user->lname)
                ->type("email", $user->email)
                ->type("address", $user->address)
                ->type("suburb", $user->suburb)
                ->type("state", $user->state)
                ->type("postcode", $user->postcode)
                ->type("phone", $user->phone)
                ->type("password", $user->password)
                ->select('select[name="role[]"]', $relations[0]->id)
                ->select('select[name="role[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.users.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user->name)
                ->assertSeeIn("tr:last-child td[field-key='lname']", $user->lname)
                ->assertSeeIn("tr:last-child td[field-key='email']", $user->email)
                ->assertSeeIn("tr:last-child td[field-key='address']", $user->address)
                ->assertSeeIn("tr:last-child td[field-key='suburb']", $user->suburb)
                ->assertSeeIn("tr:last-child td[field-key='state']", $user->state)
                ->assertSeeIn("tr:last-child td[field-key='postcode']", $user->postcode)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $user->phone)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title);
        });
    }

    public function testEditUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->create();
        $user2 = factory('App\User')->make();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $user, $user2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->click('tr[data-entry-id="' . $user->id . '"] .btn-info')
                ->type("name", $user2->name)
                ->type("lname", $user2->lname)
                ->type("email", $user2->email)
                ->type("address", $user2->address)
                ->type("suburb", $user2->suburb)
                ->type("state", $user2->state)
                ->type("postcode", $user2->postcode)
                ->type("phone", $user2->phone)
                ->type("password", $user2->password)
                ->select('select[name="role[]"]', $relations[0]->id)
                ->select('select[name="role[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.users.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user2->name)
                ->assertSeeIn("tr:last-child td[field-key='lname']", $user2->lname)
                ->assertSeeIn("tr:last-child td[field-key='email']", $user2->email)
                ->assertSeeIn("tr:last-child td[field-key='address']", $user2->address)
                ->assertSeeIn("tr:last-child td[field-key='suburb']", $user2->suburb)
                ->assertSeeIn("tr:last-child td[field-key='state']", $user2->state)
                ->assertSeeIn("tr:last-child td[field-key='postcode']", $user2->postcode)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $user2->phone)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title);
        });
    }

    public function testShowUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->create();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $user->role()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $user, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->click('tr[data-entry-id="' . $user->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $user->name)
                ->assertSeeIn("td[field-key='lname']", $user->lname)
                ->assertSeeIn("td[field-key='email']", $user->email)
                ->assertSeeIn("td[field-key='address']", $user->address)
                ->assertSeeIn("td[field-key='suburb']", $user->suburb)
                ->assertSeeIn("td[field-key='state']", $user->state)
                ->assertSeeIn("td[field-key='postcode']", $user->postcode)
                ->assertSeeIn("td[field-key='phone']", $user->phone)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title);
        });
    }

}
