<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RequestingTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateRequesting()
    {
        $admin = \App\User::find(1);
        $requesting = factory('App\Requesting')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $requesting) {
            $browser->loginAs($admin)
                ->visit(route('admin.requestings.index'))
                ->clickLink('Add new')
                ->select("user_id", $requesting->user_id)
                ->radio("pref_day", $requesting->pref_day)
                ->type("desc", $requesting->desc)
                ->press('Save')
                ->assertRouteIs('admin.requestings.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $requesting->user->name)
                ->assertSeeIn("tr:last-child td[field-key='pref_day']", $requesting->pref_day)
                ->assertSeeIn("tr:last-child td[field-key='desc']", $requesting->desc);
        });
    }

    public function testEditRequesting()
    {
        $admin = \App\User::find(1);
        $requesting = factory('App\Requesting')->create();
        $requesting2 = factory('App\Requesting')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $requesting, $requesting2) {
            $browser->loginAs($admin)
                ->visit(route('admin.requestings.index'))
                ->click('tr[data-entry-id="' . $requesting->id . '"] .btn-info')
                ->select("user_id", $requesting2->user_id)
                ->radio("pref_day", $requesting2->pref_day)
                ->type("desc", $requesting2->desc)
                ->press('Update')
                ->assertRouteIs('admin.requestings.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $requesting2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='pref_day']", $requesting2->pref_day)
                ->assertSeeIn("tr:last-child td[field-key='desc']", $requesting2->desc);
        });
    }

    public function testShowRequesting()
    {
        $admin = \App\User::find(1);
        $requesting = factory('App\Requesting')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $requesting) {
            $browser->loginAs($admin)
                ->visit(route('admin.requestings.index'))
                ->click('tr[data-entry-id="' . $requesting->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='user']", $requesting->user->name)
                ->assertSeeIn("td[field-key='pref_day']", $requesting->pref_day)
                ->assertSeeIn("td[field-key='desc']", $requesting->desc);
        });
    }

}
