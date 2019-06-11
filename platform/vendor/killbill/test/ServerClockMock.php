<?php
/*
 * Copyright 2011-2013 Ning, Inc.
 *
 * Ning licenses this file to you under the Apache License, version 2.0
 * (the "License"); you may not use this file except in compliance with the
 * License.  You may obtain a copy of the License at:
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.  See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

namespace Killbill\Client;

/**
 * Manipulate the server clock
 */
class ServerClockMock extends AbstractResource
{
    /**
     * Set the clock to a specific date
     *
     * @param string $requestedDate Date as a string
     * @param array  $headers       Headers for the request
     */
    public function setClock($requestedDate, $headers)
    {
        $uri = '/test/clock';
        if ($requestedDate) {
            $uri = $uri.'?requestedDate='.$requestedDate;
        }
        $this->createRequest($uri, null, null, null, $headers);

        // For precaution
        usleep(3000000);
    }

    /**
     * Add a specific amount of days to the clock
     *
     * @param int   $count   Days to add
     * @param array $headers Headers for the request
     */
    public function addDays($count, $headers)
    {
        $this->incrementClock($count, null, null, null, 'UTC', $headers);
    }

    /**
     * Increment the clock
     *
     * @param int    $days     Days to add
     * @param int    $weeks    Weeks to add
     * @param int    $months   Months to add
     * @param int    $years    Years to add
     * @param string $timezone Timezone as a string
     * @param array  $headers  Headers for the request
     */
    private function incrementClock($days, $weeks, $months, $years, $timeZone, $headers)
    {
        $uri = '/test/clock';
        if ($days) {
            $uri = $uri.'?days='.$days.'&timeZone='.$timeZone;
        } elseif ($weeks) {
            $uri = $uri.'?weeks='.$weeks.'&timeZone='.$timeZone;
        } elseif ($months) {
            $uri = $uri.'?months='.$months.'&timeZone='.$timeZone;
        } elseif ($years) {
            $uri = $uri.'?years='.$years.'&timeZone='.$timeZone;
        }
        $this->updateRequest($uri, null, null, null, $headers);

        // For precaution
        usleep(3000000);
    }
}
