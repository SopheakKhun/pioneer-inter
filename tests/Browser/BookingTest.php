<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class BookingTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateBooking()
    {
        $admin = \App\User::find(1);
        $booking = factory('App\Booking')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $booking) {
            $browser->loginAs($admin)
                ->visit(route('admin.bookings.index'))
                ->clickLink('Add new')
                ->select("user_id", $booking->user_id)
                ->select("requesting_id", $booking->requesting_id)
                ->type("date", $booking->date)
                ->type("installer", $booking->installer)
                ->type("model_no", $booking->model_no)
                ->type("serial_no", $booking->serial_no)
                ->radio("type", $booking->type)
                ->check("ladder_required")
                ->type("assing_to", $booking->assing_to)
                ->press('Save')
                ->assertRouteIs('admin.bookings.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $booking->user->name)
                ->assertSeeIn("tr:last-child td[field-key='requesting']", $booking->requesting->desc)
                ->assertSeeIn("tr:last-child td[field-key='date']", $booking->date)
                ->assertSeeIn("tr:last-child td[field-key='installer']", $booking->installer)
                ->assertSeeIn("tr:last-child td[field-key='model_no']", $booking->model_no)
                ->assertSeeIn("tr:last-child td[field-key='serial_no']", $booking->serial_no)
                ->assertSeeIn("tr:last-child td[field-key='type']", $booking->type)
                ->assertChecked("ladder_required")
                ->assertSeeIn("tr:last-child td[field-key='assing_to']", $booking->assing_to);
        });
    }

    public function testEditBooking()
    {
        $admin = \App\User::find(1);
        $booking = factory('App\Booking')->create();
        $booking2 = factory('App\Booking')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $booking, $booking2) {
            $browser->loginAs($admin)
                ->visit(route('admin.bookings.index'))
                ->click('tr[data-entry-id="' . $booking->id . '"] .btn-info')
                ->select("user_id", $booking2->user_id)
                ->select("requesting_id", $booking2->requesting_id)
                ->type("date", $booking2->date)
                ->type("installer", $booking2->installer)
                ->type("model_no", $booking2->model_no)
                ->type("serial_no", $booking2->serial_no)
                ->radio("type", $booking2->type)
                ->check("ladder_required")
                ->type("assing_to", $booking2->assing_to)
                ->press('Update')
                ->assertRouteIs('admin.bookings.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $booking2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='requesting']", $booking2->requesting->desc)
                ->assertSeeIn("tr:last-child td[field-key='date']", $booking2->date)
                ->assertSeeIn("tr:last-child td[field-key='installer']", $booking2->installer)
                ->assertSeeIn("tr:last-child td[field-key='model_no']", $booking2->model_no)
                ->assertSeeIn("tr:last-child td[field-key='serial_no']", $booking2->serial_no)
                ->assertSeeIn("tr:last-child td[field-key='type']", $booking2->type)
                ->assertChecked("ladder_required")
                ->assertSeeIn("tr:last-child td[field-key='assing_to']", $booking2->assing_to);
        });
    }

    public function testShowBooking()
    {
        $admin = \App\User::find(1);
        $booking = factory('App\Booking')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $booking) {
            $browser->loginAs($admin)
                ->visit(route('admin.bookings.index'))
                ->click('tr[data-entry-id="' . $booking->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='user']", $booking->user->name)
                ->assertSeeIn("td[field-key='requesting']", $booking->requesting->desc)
                ->assertSeeIn("td[field-key='date']", $booking->date)
                ->assertSeeIn("td[field-key='installer']", $booking->installer)
                ->assertSeeIn("td[field-key='model_no']", $booking->model_no)
                ->assertSeeIn("td[field-key='serial_no']", $booking->serial_no)
                ->assertSeeIn("td[field-key='type']", $booking->type)
                ->assertNotChecked("ladder_required")
                ->assertSeeIn("td[field-key='assing_to']", $booking->assing_to);
        });
    }

}
