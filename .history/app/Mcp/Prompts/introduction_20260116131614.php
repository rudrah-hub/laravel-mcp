<?php

namespace App\Mcp\Resources;

use App\Actions\BuildItinerary;
use Laravel\Mcp\Request;
use Laravel\Mcp\Server\Resource;

class Itinerary extends Resource
{
    protected string $description = "The user's upcoming flights & trips.";

    public function handle(Request $request, BuildItinerary $buildItinerary): string
    {
        $user = $request->user();

        if (! $request->user()) {
            return Response::error('User must login to view their itinerary.');
        }

        $itinerary = $buildItinerary->for($user);

        if (! $itinerary) {
            return Response::error('No flights found for this user. Maybe it is time they book a trip?');
        }

        $output = '<trips>';

        foreach ($itinerary as $trip) {
            $output .= <<<TRIP
            <trip from="{$trip->leavingAt()}" to="{$trip->returningAt()}" name="{$trip->friendlyName}">
                <departing
                    from="{$trip->departure()->from()->airportCode}"
                    to="{$trip->departure()->to()->airportCode}
                >
                    Baggage: {$trip->departure()->baggage()->allowanceText}
                    Details: {$trip->departure()->details}
                </departing>

                <returning
                    from="{$trip->return()->from()->airportCode}"
                    to="{$trip->return()->to()->airportCode}
                >
                    Baggage: {$trip->return()->baggage()->allowanceText}
                    Details: {$trip->return()->details}
                </returning>

                <costs>
                    <out>{$trip->costs()->out}</out>
                    <in>{$trip->costs()->in}</in>
                    <total>{$trip->costs()->total}</total>
                </costs>

                <notes>{$trip->usersNotes()}</notes>
            </trip>
            TRIP;
        }

        $output .= '</trips>';

        return $output;
    }
}
