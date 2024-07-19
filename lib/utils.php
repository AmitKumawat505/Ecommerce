<?php
function hash_password($str)
{
    return md5($str);
}

function compare_password($pass,$hash)
{
    return hash_equals($pass,$hash);
}
