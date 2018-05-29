<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class JobsheetTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateJobsheet()
    {
        $admin = \App\User::find(1);
        $jobsheet = factory('App\Jobsheet')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $jobsheet) {
            $browser->loginAs($admin)
                ->visit(route('admin.jobsheets.index'))
                ->clickLink('Add new')
                ->select("booking_id", $jobsheet->booking_id)
                ->select("user_id", $jobsheet->user_id)
                ->select("requesting_id", $jobsheet->requesting_id)
                ->type("finish_date", $jobsheet->finish_date)
                ->type("diagnose", $jobsheet->diagnose)
                ->type("add_info", $jobsheet->add_info)
                ->press('Save')
                ->assertRouteIs('admin.jobsheets.index')
                ->assertSeeIn("tr:last-child td[field-key='booking']", $jobsheet->booking->date)
                ->assertSeeIn("tr:last-child td[field-key='user']", $jobsheet->user->name)
                ->assertSeeIn("tr:last-child td[field-key='requesting']", $jobsheet->requesting->pref_day)
                ->assertSeeIn("tr:last-child td[field-key='finish_date']", $jobsheet->finish_date)
                ->assertSeeIn("tr:last-child td[field-key='diagnose']", $jobsheet->diagnose)
                ->assertSeeIn("tr:last-child td[field-key='add_info']", $jobsheet->add_info);
        });
    }

    public function testEditJobsheet()
    {
        $admin = \App\User::find(1);
        $jobsheet = factory('App\Jobsheet')->create();
        $jobsheet2 = factory('App\Jobsheet')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $jobsheet, $jobsheet2) {
            $browser->loginAs($admin)
                ->visit(route('admin.jobsheets.index'))
                ->click('tr[data-entry-id="' . $jobsheet->id . '"] .btn-info')
                ->select("booking_id", $jobsheet2->booking_id)
                ->select("user_id", $jobsheet2->user_id)
                ->select("requesting_id", $jobsheet2->requesting_id)
                ->type("finish_date", $jobsheet2->finish_date)
                ->type("diagnose", $jobsheet2->diagnose)
                ->type("add_info", $jobsheet2->add_info)
                ->press('Update')
                ->assertRouteIs('admin.jobsheets.index')
                ->assertSeeIn("tr:last-child td[field-key='booking']", $jobsheet2->booking->date)
                ->assertSeeIn("tr:last-child td[field-key='user']", $jobsheet2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='requesting']", $jobsheet2->requesting->pref_day)
                ->assertSeeIn("tr:last-child td[field-key='finish_date']", $jobsheet2->finish_date)
                ->assertSeeIn("tr:last-child td[field-key='diagnose']", $jobsheet2->diagnose)
                ->assertSeeIn("tr:last-child td[field-key='add_info']", $jobsheet2->add_info);
        });
    }

    public function testShowJobsheet()
    {
        $admin = \App\User::find(1);
        $jobsheet = factory('App\Jobsheet')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $jobsheet) {
            $browser->loginAs($admin)
                ->visit(route('admin.jobsheets.index'))
                ->click('tr[data-entry-id="' . $jobsheet->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='booking']", $jobsheet->booking->date)
                ->assertSeeIn("td[field-key='user']", $jobsheet->user->name)
                ->assertSeeIn("td[field-key='requesting']", $jobsheet->requesting->pref_day)
                ->assertSeeIn("td[field-key='finish_date']", $jobsheet->finish_date)
                ->assertSeeIn("td[field-key='diagnose']", $jobsheet->diagnose)
                ->assertSeeIn("td[field-key='add_info']", $jobsheet->add_info);
        });
    }

}
