<?php

function feature($name)
{
    return config('features.'.$name, true);
}
