<?php

use Carbon\Carbon;

function constants($key)
{
    return config('constants.' . $key);
}
