<?php

namespace App\Controller;

use App\Core\BaseController;
use DateTime;

class DateTimeController extends BaseController
{
    public function formats(): array
    {
        $date = new DateTime();

        return $this->success([
            'atom' => $date->format(\DateTimeInterface::ATOM),
            'cookie' => $date->format(\DateTimeInterface::COOKIE),
            'iso8601' => $date->format(\DateTimeInterface::ISO8601),
            'iso8601_expanded' => $date->format(\DateTimeInterface::RFC3339_EXTENDED),
            'rfc822' => $date->format(\DateTimeInterface::RFC822),
            'rfc850' => $date->format(\DateTimeInterface::RFC850),
            'rfc1036' => $date->format(\DateTimeInterface::RFC1036),
            'rfc1123' => $date->format(\DateTimeInterface::RFC1123),
            'rfc2822' => $date->format(\DateTimeInterface::RFC2822),
            'rfc3339' => $date->format(\DateTimeInterface::RFC3339),
            'rss' => $date->format(\DateTimeInterface::RSS),
            'w3c' => $date->format(\DateTimeInterface::W3C),
            'custom' => [
                'date_only' => $date->format('Y-m-d'),
                'time_only' => $date->format('H:i:s'),
                'datetime' => $date->format('Y-m-d H:i:s'),
                'br_date' => $date->format('d/m/Y'),
                'br_datetime' => $date->format('d/m/Y H:i:s'),
            ]
        ]);
    }
}